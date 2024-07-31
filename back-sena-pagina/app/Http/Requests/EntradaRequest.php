<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaRequest extends FormRequest
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
            'titulo' => 'required|string|max:100',
            'titulo_ingles'=>'required|string|max:100',
            'titulo_emb'=>'required|string|max:100',
            'descripcion_corta' => 'required|string|max:255',
            'descripcion_corta_ingles' => 'max:255',
            'descripcion_corta_emb' => 'max:255',
            'descripcion_larga' => 'max:1000',
            'descripcion_larga_ingles' => 'max:1000',
            'descripcion_larga_emb' => 'max:1000',
            'autor' => 'required|exists:autores,id',
            'miniatura' => 'file|mimes:jpeg,png,gif,jpg,tiff,svg'
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'Se debe ingresar el titulo de la entrada',
            'titulo.max' => 'El titulo debe tener menos de 100 caracteres',
            'titulo_ingles.required' => 'Se debe ingresar el titulo en ingles de la entrada',
            'titulo_ingles.max' => 'El titulo en ingles debe tener menos de 100 caracteres',
            'titulo_emb.required' => 'Se debe ingresar el titulo en embera de la entrada',
            'titulo_emb.max' => 'El titulo en embera debe tener menos de 100 caracteres',
            'descripcion_corta.required' => 'Se debe tener una descripcion corta',
            'descripcion_corta.max' => 'La descripcion corta debe tener menos de 255 caracteres',
            'descripcion_corta_ingles.max' => 'La descripcion corta en ingles debe tener menos de 255 caracteres',
            'descripcion_corta_emb.max' => 'La descripcion corta en embera debe tener menos de 255 caracteres',
            'descripcion_larga.required' => 'Se debe tener una descripcion larga',
            'descripcion_larga.max' => 'La descripcion larga debe tener menos de 1000 caracteres',
            'descripcion_larga_ingles.max' => 'La descripcion larga en ingles debe tener menos de 1000 caracteres',
            'descripcion_larga_emb.max' => 'La descripcion larga en embera debe tener menos de 1000 caracteres',
            'autor.required' => 'Se debe añadir un autor para la entrada',
            'autor.exists' => 'El autor ingresado no existe en la base de datos',
            'miniatura.file' => 'En este campo solo se pueden ingresar archivos en los siguientes formatos: jpeg, png, jpg, tiff, svg',
            'miniatura.mimes' => 'En este campo solo se pueden ingresar archivos en los siguientes formatos: jpeg, png, jpg, tiff, svg'
        ];
    }
}
