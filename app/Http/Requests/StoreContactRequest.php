<?php

namespace App\Http\Requests;

use App\Models\Email;
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        preg_match_all('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $this->emails, $matches);
        $this->merge([
            'emails' => $this->checkEmailUniqueness($matches[0]),
            'totalEmail' => count($matches[0])
        ]);
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
            'emails' => 'required|array|min:1',
            'emails.*' => 'email',
            'mobile' => 'numeric|nullable',
            'phone' => 'numeric|nullable',
            'website' => 'string|nullable',
            'company' => 'string|nullable',
            'category' => 'required|numeric|nullable',
            'country' => 'string|nullable',
            'address' => 'string|nullable|max:250'
        ];
    }

    /**
     * Get the unique emails form a list of emails
     */
    private function checkEmailUniqueness($emailList): array|null
    {
        $uniqueEmails = empty($emailList) ? null : array_unique($emailList);
        $existingEmails = Email::whereIn('email', $uniqueEmails)->pluck('email')->toArray();
        $returningEmails = array_diff($uniqueEmails, $existingEmails);
        return count($returningEmails) > 0 ? $returningEmails : null;
    }
}
