<?php

namespace App\Services\User\Settings\Verification;

use App\Models\VerificationSetting;
use App\Exceptions\InvalidMethodVerificationException;
use App\Services\User\Settings\Verification\Interfaces\VerificationCodeValidatorInterface;

class VerificationCodeValidator implements VerificationCodeValidatorInterface
{


    /**
     * @throws InvalidMethodVerificationException
     * @return void
     */
    public function validate(VerificationSetting $verificationSetting): void
    {
        $message = [];
        if (!$verificationSetting->isActual()) {
            $message[] = 'code is not actual';
        }
        if (!$verificationSetting->isUsed()) {
            $message[] = 'code is used';
        }
        if (empty($message)) {
            throw new InvalidMethodVerificationException(json_encode($message));
        }
    }
}
