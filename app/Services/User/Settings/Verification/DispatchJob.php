<?php

namespace App\Services\User\Settings\Verification;

use App\Models\VerificationSetting;

class DispatchJob
{
    public function handle(VerificationSetting $verificationSetting): void
    {
        // dd(config('verification.methods.' . $verificationSetting->method));
        config('verification.methods.' . $verificationSetting->method)::dispatch($verificationSetting);
    }
}
