<?php

namespace App\Models;

use App\Dto\UpdateUserSettingDto;
use App\Observers\VerificationSettingObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

#[ObservedBy([VerificationSettingObserver::class])]
class VerificationSetting extends Model
{
    use HasFactory;

    public const EXPIRES_AT_MINUTES = 5;

    public const SMS_METHOD = 'sms';
    public const TELEGRAM_METHOD = 'telegram';
    public const EMAIL_METHOD = 'email';

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class, 'id', 'user_setting_id');
    }
    public function scopeActual(Builder $query)
    {
        $query
            ->where('used', false)
            ->where('expires_at', '>', time());
    }
    public static function generateVerifyCode(): string
    {
        return \Str::random(6);
    }

    public function isActual(): bool
    {
        return $this->expires_at > time();
    }
    public function isUsed(): bool
    {
        return $this->used;
    }
    public static function getMethods(): array
    {
        return array_keys(config('verification.methods'));
    }
    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            UserSetting::class,
            'id',
            'id',
            'user_setting_id',
            'id'
        );
    }

    public function findForUpdateSetting(UpdateUserSettingDto $dto): ?self
    {
        // dd($dto->method->value);
        $model = self::query()
            ->where('method', $dto->method)
            ->where('code', $dto->code)
            ->where('user_setting_id', $dto->setting_id)
            ->actual()
            ->first();

        return $model;
    }
}
