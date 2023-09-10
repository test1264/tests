<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'user_id' => 'required',
            'region' => 'required|min:3',
            'city' => 'required|min:3',
            'street' => 'required|min:3',
            'house' => 'required|max:4',
            'zipcode' => 'required|min:6|max:6'
        ];
    }
}
