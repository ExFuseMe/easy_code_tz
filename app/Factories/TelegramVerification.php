<?php

namespace App\Factories;

class TelegramVerification extends VerificationMethodFactory
{
    public function __construct()
    {
        $this->code = rand(100000, 999999);
    }

    function sendVerificationCode(): int
    {
        // реализация отправки telegram кода
        return $this->code;
    }
}
