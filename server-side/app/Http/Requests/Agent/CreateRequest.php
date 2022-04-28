<?php

namespace App\Http\Requests\Agent;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:agents'],
            'password' => ['required'],
        ];
    }
}
