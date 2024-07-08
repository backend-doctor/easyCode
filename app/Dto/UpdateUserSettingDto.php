<?php

namespace App\Dto;


class UpdateUserSettingDto
{
    public function __construct(
        public readonly string $method,
        public readonly string $code,
        public readonly int $setting_id
    )
    {}
    public static function fillRequest(\Illuminate\Http\Request $request)
    {
        return new self(
            $request->method,
            $request->code,
            $request->setting_id
        );
    }
}
