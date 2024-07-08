<?php


return [
    'methods' => [
        'email' => \App\Jobs\EmailVerificationJob::class,
        'sms' =>  \App\Jobs\SmsVerificationJob::class,
        'telegram' => \App\Jobs\TelegramVerificationJob::class
    ]
];
