<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'email'=> ['required','email'], 
            'service' => ['required', 'exists:services,id'],
            'password'=> ['required', 'min:4'],
        ];
    }

    
}
