<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'sku' => 'required|string|max:255',
            'stock_status' => 'required|in:instock,outofstock', // 'instock' or 'outofstock'
            'category_ids' => 'required',
            'category_ids.*' => 'exists:categories,id', // Validate category IDs exist in the categories table
            'brand_id' => 'required|exists:brands,id',
            'tags_ids' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Single image validation
            'images' => 'nullable|array', // Multiple images (array)
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Multiple image validation
        ];

        
    }



    public function messages()
    {
        return [
            'category_ids' => 'The category field is required.',
            'tags_ids' => 'The tags field is required.',
            'brand_id' => 'The brand field is required.',
           
        ];
    }
}
