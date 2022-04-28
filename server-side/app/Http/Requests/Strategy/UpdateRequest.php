<?php

namespace App\Http\Requests\Strategy;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'min_limit' => ['required', 'numeric', 'min:0'],
            'max_limit' => ['required', 'numeric', 'min:' . $this->get('min_limit')],
            'tariff'    => ['required', 'numeric'],
        ];
    }
}
