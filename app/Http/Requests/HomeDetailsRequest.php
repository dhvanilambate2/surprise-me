<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_name' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'short_description' => 'required|string',
        ];
    }
}
