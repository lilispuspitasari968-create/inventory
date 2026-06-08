<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
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
            'slug'        => Str::slug($this->name ?? ''),
        ]);
    }

    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'slug'        => 'required|unique:categories,slug',
            'description' => 'nullable|string',
        ];
    }
}