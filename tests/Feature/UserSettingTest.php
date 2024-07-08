<?php

namespace Tests\Feature;

use App\Models\UserSetting;
use App\Models\VerificationSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserSettingTest extends TestCase
{
    public function test_a_can_generate_verification_setting(): void
    {
        $this->withoutExceptionHandling();
        Artisan::call('migrate:fresh --seed');
        $method = VerificationSetting::TELEGRAM_METHOD;
        $setting = UserSetting::first();
        auth()->loginUsingId($setting->user_id);
        $data = [
            'setting_id' => $setting->id,
            'value' => 'test',
            'method_verify' => $method,
        ];

        $response = $this->post(route('user.setting.generate-verification'), $data);
        $response->assertOk();
    }
    public function test_a_can_update_setting(): void
    {
        $this->withoutExceptionHandling();
        Artisan::call('migrate:fresh --seed');
        $verificationSetting = $this->createVerificationSetting(VerificationSetting::EMAIL_METHOD);
        $setting = $verificationSetting->userSetting;
        auth()->loginUsingId($setting->user_id);
        $data = [
            'setting_id' => $verificationSetting->user_setting_id,
            'code' => $verificationSetting->code,
            'method' => $verificationSetting->method,
        ];
        // dd($data);
        $response = $this->patch(route('user.setting.update'), $data);
        $response->assertOk();

        $newSetting = $setting->fresh();

        $this->assertNotEquals($setting->value, $newSetting->value);
        $this->assertEquals($newSetting->value, $verificationSetting->value);
    }

    private function createVerificationSetting(string $method): VerificationSetting
    {
        $model = new VerificationSetting;
        $model->user_setting_id = UserSetting::first()->id;
        $model->code = VerificationSetting::generateVerifyCode();
        $model->method = $method;
        $model->value = 'test123';
        $model->expires_at = Carbon::now()->addMinutes(VerificationSetting::EXPIRES_AT_MINUTES)->timestamp;
        $model->save();

        return $model;
    }
}
