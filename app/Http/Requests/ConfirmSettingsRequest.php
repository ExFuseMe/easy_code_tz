<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmSettingsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'verification_code' => ['required', 'string'],
        ];
    }
}
