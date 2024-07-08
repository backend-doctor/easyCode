<?php

namespace App\Http\Requests;

use App\Models\VerificationSetting;
use Illuminate\Foundation\Http\FormRequest;

class StoreVerificationSettingRequest extends FormRequest
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
            'value' => 'required|string',
            'method_verify' => 'required|string|in:' . implode(',', VerificationSetting::getMethods()),
        ];
    }
}
