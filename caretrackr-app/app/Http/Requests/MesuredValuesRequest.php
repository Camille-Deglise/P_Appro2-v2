<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MesuredValuesRequest extends FormRequest
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
            'systole' => ['integer', 'nullable'],
            'diastole' =>['integer', 'nullable'],
            'temperature' =>['numeric', 'nullable'],
            'oxygen_saturation' =>['integer', 'nullable'],
            'pulse' =>['integer', 'nullable'],
            'blood_sugar' => ['numeric', 'nullable'],
            'mesured_at' => ['required', 'date'],
            'patient_id' =>['required', 'exists:patients,id']
        ];
    }
}
