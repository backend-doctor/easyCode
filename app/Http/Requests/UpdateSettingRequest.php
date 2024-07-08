<?php

namespace App\Http\Requests;

use App\Enum\VerificationMethod;
use App\Models\VerificationSetting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'setting_id' => 'required|integer|exists:user_settings,id',
            'code' => 'required|exists:verification_settings,code',
            'method' => 'required|in:' . implode(',', VerificationSetting::getMethods()),
        ];
    }
}
