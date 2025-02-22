<?php

namespace App\Factories;

class SmsVerification extends VerificationMethodFactory
{
    public function __construct()
    {
        $this->code = rand(100000, 999999);
    }

    function sendVerificationCode(): int
    {
        // реализация отправки sms кода
        return $this->code;
    }
}
