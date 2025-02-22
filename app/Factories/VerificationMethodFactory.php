<?php

namespace App\Factories;

abstract class VerificationMethodFactory
{
    public int $code;
    public static function create(string $method): SMSVerification|EmailVerification|TelegramVerification
    {
        return match (strtolower($method)) {
            'sms' => new SMSVerification(),
            'telegram' => new TelegramVerification(),
            default => new EmailVerification(),
        };
    }
    abstract function sendVerificationCode();
}
