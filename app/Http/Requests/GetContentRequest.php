<?php

namespace App\Http\Requests;

use App\Enums\CategoryName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetContentRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if ($this->get('type')) {
            $this->merge([
                'type' => strtoupper($this->get('type'))
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', new Enum(CategoryName::class), 'string'],
            'q' => ['nullable', 'string']
        ];
    }
}
