<?php

namespace App\Swagger\Requests;
/**
 * @OA\Schema ()
 */
class ConfirmSettingRequest
{
    /**
     * @OA\Property()
     */
    public string $verification_code;
}
