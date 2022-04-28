<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'unique:staff'],
            'password' => ['required'],
        ];
    }
}
