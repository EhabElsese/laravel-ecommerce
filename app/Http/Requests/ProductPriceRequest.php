<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPriceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'price' => 'required|min:0|numeric',
            'product_id' => 'required|exists:products,id',
            'special_price' => 'nullable|numeric',
            
            'special_price_start' => 'required_with:special_price|nullable|date_format:Y-m-d',
            'special_price_end' => 'required_with:special_price|nullable|date_format:Y-m-d',
            'special_price_type' => 'required_with:special_price|in:fixed,percent',

        ];
    }
}
