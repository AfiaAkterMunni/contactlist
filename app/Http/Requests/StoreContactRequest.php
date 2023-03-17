<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
        preg_match_all('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $this->emails, $matches);
        $this->merge([
            'emails' => empty($matches[0]) ? null : $matches[0],
        ]);
        // dd($this->emails);
        return [
            
            'name' => 'string|nullable',
            'emails' => 'required|array|min:1',
            'emails.*' => 'email|unique:emails,email',
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
