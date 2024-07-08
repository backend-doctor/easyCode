<?php

namespace App\Jobs;

use App\Models\VerificationSetting;
use App\Services\User\Settings\Verification\TelegramVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TelegramVerificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, BaseVerificationJob;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly VerificationSetting $verificationSetting)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(TelegramVerification $service): void
    {
        $service->send($this->verificationSetting);
    }
}
