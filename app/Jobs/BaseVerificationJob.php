<?php

namespace App\Jobs;

use Illuminate\Queue\Middleware\WithoutOverlapping;

trait BaseVerificationJob
{
    public function middleware(): array
    {
        return [(new WithoutOverlapping($this->verificationSetting->id))
            ->releaseAfter(60)];
    }


    public function failed($exception): void
    {
        $this->fail(json_encode((array)$exception ?? []));
    }
}
