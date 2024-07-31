<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
        $regla_cedula =$this->id == 0 ? 'unique:users,cedula|required|numeric|digits:10,' . $this->id : '';
        return [
            'nombre'=>'required|max:100|regex:/^[A-Za-z\s]+$/',
            'apellido'=>'required|max:100|regex:/^[A-Za-z\s]+$/',
            'cedula'=> $regla_cedula,
            'celular'=>'required|numeric|digits:10',
            'email'=>'required|email|max:100'
        ];
    }

    public function messages()
    {
        if($this->id == 0){
            return [
                'nombre.required'=>'el nombre del usuario es obligatorio',
                'nombre.regex'=>'este campo solo puede contener letras',
                'nombre.max'=>'el numero de caracteres es muy grande',
                'cedula.unique' => 'El número de cedula ya está presente en la base de datos',
                'cedula.required' => 'Se debe ingresar el número de cedula',
                'cedula.numeric' => 'Este campo solo debe contener datos númericos',
                'cedula.digits' => 'Este campo solo debe tener 10 digitos',
                'apellido.required'=>'el apellido del usuario es obligatorio',
                'apellido.regex'=>'este campo solo puede contener letras',
                'apellido.max'=>'el numero de caracteres es muy grande',
                'celular.required'=>'se debe ingresar un numero de celular',
                'celular.numeric'=>'este campo solo se pueden ingresar datos numericos',
                'celular.digits'=>'El número de celular debe tener 10 cifras exactas',
                'email.required'=>'se debe ingresar un correo electronico',
                'email.email'=>'direccion de correo no valido',
                'email.max'=>'el numero de caracteres es muy grande'
            ];
        }else {
            return [
                'nombre.required'=>'el nombre del usuario es obligatorio',
                'nombre.regex'=>'este campo solo puede contener letras',
                'nombre.max'=>'el numero de caracteres es muy grande',
                'apellido.required'=>'el apellido del usuario es obligatorio',
                'apellido.regex'=>'este campo solo puede contener letras',
                'apellido.max'=>'el numero de caracteres es muy grande',
                'celular.required'=>'se debe ingresar un numero de celular',
                'celular.numeric'=>'este campo solo se pueden ingresar datos numericos',
                'celular.digits'=>'El número de celular debe tener 10 cifras exactas',
                'email.required'=>'se debe ingresar un correo electronico',
                'email.email'=>'direccion de correo no valido',
                'email.max'=>'el numero de caracteres es muy grande'
            ];
        }

    }
}
