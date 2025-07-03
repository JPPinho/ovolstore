<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; //TODO Auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'sku' => 'sometimes|required|string|max:255|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer',
            'categories' => 'sometimes|required|array',
            'categories.*' => 'exists:categories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A product name is required.',
            'sku.unique' => 'This sku is taken.',
            'price.min' => 'Price must be greater than zero.',
            'categories.*.exists' => 'The selected category does not exist.',
            'categories.required' => 'A category is required.',
            'categories.array' => 'Categories must be an array.',
        ];
    }

}
