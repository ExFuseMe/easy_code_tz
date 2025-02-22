<?php

namespace App\Factories;

class EmailVerification extends VerificationMethodFactory
{
    public function __construct()
    {
        $this->code = rand(100000, 999999);
    }
    function sendVerificationCode(): int
    {
        // реализация отправки email письма
        return $this->code;
    }
}
