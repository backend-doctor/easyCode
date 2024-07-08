<?php

namespace App\Http\Controllers;

use App\Dto\GenerateVerificationSettingDto;
use App\Dto\UpdateUserSettingDto;
use App\Http\Requests\StoreVerificationSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\VerificationSetting;
use App\Services\User\Settings\Interfaces\SettingServiceInterface;
use Illuminate\Http\JsonResponse;

class UserSettingController extends Controller
{
    public function __construct(private readonly SettingServiceInterface $service)
    {
    }
    public function generateVerificationSetting(StoreVerificationSettingRequest $request): JsonResponse
    {
        $this->authorize('create', [VerificationSetting::class, $request->setting_id]);
        $this->service->generateVerificationSetting(GenerateVerificationSettingDto::fillRequest($request));
        return response()->json();
    }
    public function verifyCode(UpdateSettingRequest $request, VerificationSetting $verificationSetting): JsonResponse
    {
        $verificationSetting = $verificationSetting->findForUpdateSetting(UpdateUserSettingDto::fillRequest($request));
        $this->authorize('update', [$verificationSetting, $request->setting_id]);
        $this->service->update($verificationSetting);

        return response()->json();
    }
}
