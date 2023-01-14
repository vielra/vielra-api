<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CheckAvailabilityUsernameController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $user = User::where('username', $request->username)->first();
            if ($user) {
                return response()->json([
                    'availability'     => false
                ]);
            } else {
                return response()->json([
                    'availability'     => true
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ]);
        }
    }
}
