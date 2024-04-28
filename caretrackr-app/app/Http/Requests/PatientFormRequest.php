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

            'name' => ['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'firstname'=>['required','string', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'birth_date' =>['required', 'date'],
            'gender' => ['required', 'integer'],
            'health_status_id' =>['required', 'integer'],
            'reason_hospitalization' => ['required', 'string',],
            'medication' =>['array', 'exists:medications,id'],
            'allergy' =>['array', 'exists:allergies,id'],
            'medical_history'=>['array', 'exists:medical_histories,id'],
            'avs_number' =>['required', 'regex:/^(756){1}\.[0-9]{4}\.[0-9]{4}\.[0-9]{2}/'],
            'insurance' =>['required', 'string','regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'road_number'=>['required', 'regex:/^\d{1,3}[a-zA-Z]*$/',],
            'road' =>['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/'],
            'npa'=>['required', 'regex:/^\d{1,5}$/'],
            'city' =>['required', 'string','regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/' ],
            'country' =>['required', 'string','regex:/^[a-zA-ZÀ-ÿ\-\' ]+$/']
            
        ];
    }
}
