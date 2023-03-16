<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourceUser;
use App\Models\SocialAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function getUrl($provider)
    {
        return Response::json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = null;

        DB::transaction(function () use ($providerUser, &$user, &$provider) {

            $photoUrl = null;

            if ($provider === 'facebook') {
                $photoUrl = $providerUser->avatar_original . "&access_token=$providerUser->token";
            } else if ($provider === 'google') {
                $photoUrl = $this->getGoogleAvatarUser($providerUser->getAvatar());
            } else {
                $photoUrl = $providerUser->getAvatar();
            }

            $socialAccount  = SocialAccount::updateOrCreate(
                [
                    'social_id'         => $providerUser->getId(),
                    'social_provider'   => $provider,
                ],
                [
                    'social_name'       => $providerUser->getName(),
                    'social_photo_url'  => $photoUrl,
                ]
            );

            if (!($user = $socialAccount->user)) {
                $userName = Str::slug($providerUser->getName(), '_') . time();
                $user = User::create([
                    'name'              => $providerUser->getName(),
                    'username'          => $userName,
                    'email'             => $providerUser->getEmail(),
                    'email_verified_at' => Carbon::now(),
                ]);
                $socialAccount->fill(['user_id' => $user->id])->save();
            }
        });

        $token = $user->createToken($user->email)->plainTextToken;
        return $this->responseWithToken($token, $user->fresh());
    }

    private function responseWithToken($token, $user)
    {
        return Response::json([
            'token'       => $token,
            'user'        => new ResourceUser($user)
        ], JsonResponse::HTTP_OK);
    }

    private function getGoogleAvatarUser(string $avatarUrl): string
    {
        if (Str::contains($avatarUrl, 's96')) {
            return  Str::replace('s96', 's500', $avatarUrl);
        } else {
            return $avatarUrl;
        }
    }
}
