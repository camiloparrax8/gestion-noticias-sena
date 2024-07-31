<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'cargo' =>   'required|string|max:255',
            'profesion' =>  'required|string|max:255'  
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre debe tener menos de 256 caracteres.',

            'cargo.required' => 'El cargo es obligatorio.',
            'cargo.max' => 'El cargo debe tener menos de 256 caracteres.',

            'profesion.required' => 'La profesion es obligatoria.',
            'profesion.max' => 'la profesion debe tener menos de 256 caracteres.',
        ];
    }
}
