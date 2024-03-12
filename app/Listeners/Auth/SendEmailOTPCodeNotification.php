<?php

namespace App\Listeners\Auth;

use App\Events\Auth\RequestedResetPassword;
use App\Mail\Auth\OTPResetPassword;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailOTPCodeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RequestedResetPassword $event): void
    {
        try {
            Mail::to($event->data['email'])->send(new OTPResetPassword([
                'code'      => $event->data['code'],
                'email'     => $event->data['email'],
            ]));
        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
