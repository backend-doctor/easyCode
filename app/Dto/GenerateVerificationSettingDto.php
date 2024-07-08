<?php

namespace App\Dto;

class GenerateVerificationSettingDto
{
    public function __construct(
        public readonly int $user_setting_id,
        public readonly string $value,
        public readonly string $method_verify,
    )
    {}
    public static function fillRequest(\Illuminate\Http\Request $request)
    {
        return new self(
            $request->setting_id,
            $request->value,
            $request->method_verify
        );
    }
}
