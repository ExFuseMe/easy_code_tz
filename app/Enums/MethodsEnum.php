<?php

namespace App\Enums;

enum MethodsEnum: string
{
    case sms = "sms";
    case telegram = "telegram";
    case email = "email";
}
