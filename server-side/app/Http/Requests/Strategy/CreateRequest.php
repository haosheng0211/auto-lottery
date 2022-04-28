<?php

namespace App\Http\Requests\Strategy;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'staff_id'  => ['required', 'exists:staff,id'],
            'member_id' => ['required', 'exists:members,id'],
            'min_limit' => ['required', 'numeric', 'min:0'],
            'max_limit' => ['required', 'numeric', 'min:' . $this->get('min_limit')],
            'tariff'    => ['required', 'numeric'],
        ];
    }
}
