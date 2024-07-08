<?php

namespace App\Services\User\Settings\Verification\Interfaces;

use App\Models\VerificationSetting;

interface VerificationMethodInterface
{
    public function __construct(VerificationCodeValidatorInterface $validator);
    public function send(VerificationSetting $verificationSetting): bool;
}
