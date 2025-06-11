<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:rental_agreement,service_contract,nda'],
            'parties.party1' => ['required', 'string', 'max:255'],
            'parties.party2' => ['required', 'string', 'max:255'],
            'terms.start_date' => ['required', 'date'],
            'terms.duration_months' => ['required', 'integer', 'min:1'],
        ];
    }
}
