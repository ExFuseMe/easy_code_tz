<?php

namespace App\Swagger\Requests;

/**
 * @OA\Schema ()
 */
class UpdateSettingRequest
{
    /**
     * @OA\Property (enum={"sms", "telegram", "email", "специально нерабочий вариант"})
     */
    public string $verification_method;
    /**
     * @OA\Property ()
     */
    public string $new_value;
}
