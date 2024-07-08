<?php

namespace App\Services\User\Settings\Verification\Interfaces;

use App\Models\VerificationSetting;

interface VerificationCodeValidatorInterface
{
    public function validate(VerificationSetting $verificationSetting): void;
}
