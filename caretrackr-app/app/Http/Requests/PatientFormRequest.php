<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientFormRequest extends FormRequest
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

            'name' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'firstname'=>['required','string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'gender' => ['required', 'digit_between: 0-3'],
            'reason_hospitalization' => ['required', 'exists:patient_service,reason_hospitalization'],
            'service_id' =>['required', 'exists:services,id'],
            'health_status'=>['required', 'exists:health_statuses,id'],
            'medication' =>['array', 'exists:medications,id'],
            'allergy' =>['array', 'exists:allergies,id'],
            'medical_histories'=>['array', 'exists:medical_histories,id'],
            'avs_number' =>['required', 'regex:/^(756){1}\.[0-9]{4}\.[0-9]{4}\.[0-9]{2}'],
            'insurance' =>['required', 'string','regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'road_number'=>['required', 'integer', 'max:4'],
            'road' =>['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'npa'=>['required', 'integer', 'max:6'],
            'city' =>['required', 'string','regex:/^[-a-zA-ZÀ-ÿ]+$/' ]
            
        ];
    }
}
