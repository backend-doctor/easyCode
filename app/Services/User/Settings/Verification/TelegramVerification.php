<?php

namespace App\Services\User\Settings\Verification;
use App\Models\User;
use App\Models\VerificationSetting;
use App\Services\User\Settings\Verification\Interfaces\VerificationCodeValidatorInterface;
use App\Services\User\Settings\Verification\Interfaces\VerificationMethodInterface;

class TelegramVerification implements VerificationMethodInterface
{
    public function __construct(private readonly VerificationCodeValidatorInterface $validator) {
    }
    public function send(VerificationSetting $verificationSetting): bool
    {
        $this->validator->validate($verificationSetting);
        //code

        \Log::info('telegram)12', [
            'send!!!'
        ]);
        return true;
    }
}
