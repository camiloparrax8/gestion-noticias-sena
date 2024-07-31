<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MultimediaRequest extends FormRequest
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
        $rules = [
            'tipo' => 'required',
        ];

        if ($this->input('tipo') !== 'video') {
            $rules['url'] = 'required|file';
        } else {
            $rules['url_video'] = 'required|url';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tipo.required' => 'Se debe ingresar el tipo de archivo',
            'url.required' => 'Se debe ingresar el archivo',
            'url_video.required' => 'Se debe ingresar la URL del video',
            'url_video.url' => 'La URL del video debe ser válida'
        ];
    }
}
