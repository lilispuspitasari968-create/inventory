<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'name'        => trim(strip_tags($this->name ?? '')),
            'description' => trim(strip_tags($this->description ?? '')),
        ]);
    }

    public function rules()
    {
        return [
            'category_id' => 'sometimes|exists:categories,id',
            'name'        => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'quantity'    => 'sometimes|integer|min:0',
            'price'       => 'sometimes|numeric|min:0',
        ];
    }
}