<?php

namespace App\Services\User\Settings;

use App\Dto\GenerateVerificationSettingDto;
use App\Models\UserSetting;
use App\Models\VerificationSetting;
use App\Services\User\Settings\Interfaces\SettingServiceInterface;
use Carbon\Carbon;

class SettingService implements SettingServiceInterface
{
    public function generateVerificationSetting(GenerateVerificationSettingDto $dto): VerificationSetting
    {
        $model = new VerificationSetting;
        $model->user_setting_id = $dto->user_setting_id;
        $model->code = VerificationSetting::generateVerifyCode();
        $model->method = $dto->method_verify;
        $model->value = $dto->value;
        $model->expires_at = Carbon::now()->addMinutes(VerificationSetting::EXPIRES_AT_MINUTES)->timestamp;
        $model->save();

        return $model;
    }

    public function update(VerificationSetting $verificationSetting): UserSetting
    {
        $setting = $verificationSetting->userSetting;
        $setting->value = $verificationSetting->value;
        $setting->save();
        return $setting;
    }
}
