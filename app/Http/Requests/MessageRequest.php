<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'email' => 'required|email|max:100',
            'name' => 'required|max:100',
            'phone' => 'max:20',
            'body' => 'required|min:3',
        ];
    }

    /**
     * Send a message to rules
     * 
     * @return string
     */
    public function messages()
    {
        return [
            'email.required'  => 'El :attribute es obligatorio.',
            'email.max'       => 'El :attribute debe tener como máximo 100 caracteres.',
            'name.max'       => 'El :attribute debe tener como máximo 100 caracteres.',
            'name.required'  => 'El :attribute es obligatorio.',
            'phone.max'       => 'El :attribute debe tener como máximo 20 caracteres.',
            'body.required' => 'El :attribute es obligatorio.',
            'body.min'      => 'El mínimo de :attribute es 3 caracteres'
        ];
    }

    public function attributes()
    {
        return [
            'body' => 'mensaje',
            'name' => 'nombre',
            'phone' => 'teléfono'
        ];
    }
}
