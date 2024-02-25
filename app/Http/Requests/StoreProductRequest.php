<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'price' => ['required', 'numeric', 'gte:0'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'descriptions' => ['nullable', 'max:5000'],

            'product_features' => ['nullable', 'array', 'min:1', 'max:50'],
            'product_features.*.feature' => ['required', 'string', 'max:1000']
        ];
    }
}
