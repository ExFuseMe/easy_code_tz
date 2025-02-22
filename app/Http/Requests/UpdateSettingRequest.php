<?php

namespace App\Http\Requests;

use App\Enums\MethodsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'verification_method' => ['required', Rule::enum(MethodsEnum::class)],
            'new_value' => ['required', 'string'],
        ];
    }
}
