<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|nullable',
            'email' => 'required|email|unique:emails,email,'.$this->id,
            'mobile' => 'numeric|nullable',
            'phone' => 'numeric|nullable',
            'website' => 'string|nullable',
            'company' => 'string|nullable',
            'category' => 'required|numeric|nullable',
            'country' => 'string|nullable',
            'address' => 'string|nullable'
        ];
    }
}
