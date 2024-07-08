<?php

namespace App\Providers;

use App\Services\User\Settings\Interfaces\SettingServiceInterface;
use App\Services\User\Settings\SettingService;
use App\Services\User\Settings\Verification\Interfaces\VerificationCodeValidatorInterface;
use App\Services\User\Settings\Verification\VerificationCodeValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
        $this->app->bind(VerificationCodeValidatorInterface::class, VerificationCodeValidator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
