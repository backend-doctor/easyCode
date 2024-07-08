<?php

namespace App\Services\User\Settings\Interfaces;

use App\Dto\GenerateVerificationSettingDto;
use App\Models\UserSetting;
use App\Models\VerificationSetting;

interface SettingServiceInterface
{
    public function generateVerificationSetting(GenerateVerificationSettingDto $dto): VerificationSetting;
    public function update(VerificationSetting $verificationSetting): UserSetting;
}
