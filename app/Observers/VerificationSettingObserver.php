<?php

namespace App\Observers;

use App\Jobs\UserSetting\SendVerificationCodeJob;
use App\Models\VerificationSetting;
use App\Services\User\Settings\Verification\DispatchJob;

class VerificationSettingObserver
{
    public function __construct(private readonly DispatchJob $job) {
    }
    /**
     * Handle the VerificationSetting "created" event.
     */
    public function created(VerificationSetting $verificationSetting): void
    {
        $this->job->handle($verificationSetting);
        // SendVerificationCodeJob::dispatch($verificationSetting);
    }
}
