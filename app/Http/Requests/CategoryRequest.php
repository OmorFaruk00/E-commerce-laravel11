<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('category') ? $this->route('category')->id : null;
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required', Rule::unique('categories', 'slug')->ignore($categoryId),
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
