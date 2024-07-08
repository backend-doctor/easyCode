<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserSetting;
use App\Models\VerificationSetting;

class VerificationSettingPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $user_setting_id): bool
    {
        return UserSetting::query()
            ->where('user_id', $user->id)
            ->whereId($user_setting_id)
            ->exists();
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, VerificationSetting $verificationSetting, int $user_setting_id): bool
    {
        return $verificationSetting->user_setting_id === $user_setting_id
            && $verificationSetting->userSetting->user_id === $user->id;
    }
}
