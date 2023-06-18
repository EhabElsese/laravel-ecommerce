<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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
            'name' => 'required',
            'value' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب ادخال الاسم',
            'value.required' => 'يجب ادخال قيمة التوصيل ',
        ];
    }
}
