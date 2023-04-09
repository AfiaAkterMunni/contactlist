<?php

namespace App\Http\Requests;

use App\Models\Email;
use Illuminate\Foundation\Http\FormRequest;

use function GuzzleHttp\Promise\all;

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
        if(isset($this->emails))
        {
            preg_match_all('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', $this->emails, $matches);
            $this->merge([
                'emails' => $matches[0],
                'uniqueEmails' => $this->getUniqueEmails($matches[0])
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // dd($this->all());
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
            'address' => 'string|nullable|max:250',
            'uniqueEmails' => 'required',
        ];
        
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'uniqueEmails.required' => 'All the emails are duplicated. Please provide unique email to store.',
        ];
    }

    /**
     * Get the unique emails form a list of emails
     */
    private function getUniqueEmails($emailList): array|null
    {
        $uniqueEmails = empty($emailList) ? null : array_unique($emailList);
        $existingEmails = Email::whereIn('email', $uniqueEmails)->pluck('email')->toArray();
        $returningEmails = array_diff($uniqueEmails, $existingEmails);
        return count($returningEmails) > 0 ? $returningEmails : null;
    }
}
