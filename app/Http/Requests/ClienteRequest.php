<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DocumentoIdentidadValido;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_apellidos' => ['required', 'min:3', 'max:50'],
            'documento_identidad' => ['required', new DocumentoIdentidadValido],
            'fecha_nacimiento' => ['nullable'],
            'domicilio' => ['nullable'],
            'codigo_postal' => ['nullable'],
            'municipio' => ['required'],
            'provincia' => ['required'],
            'provincia_nombre' => ['required'],
            'telefono' => ['required', 'regex:/^[6-9]\d{8}$/'],
            'email' => ['required', 'email']
        ];
    }

    public function messages()
    {
        return [
            'nombre_apellidos.required' => 'Nombre completo requerido',
            'nombre_apellidos.min' => 'Minimo 3 caracteres',
            'nombre_apellidos.max' => 'Máximo 50 caracteres',
            'documento_identidad.required' => 'NIF/CIF requerido',
            'documento_identidad.DocumentoIdentidadValido' => 'NIF/CIF erroneo',
            'fecha_nacimiento' => 'nullable',
            'domicilio' => 'nullable',
            'codigo_postal' => 'nullable',
            'municipio.required' => 'Municipio requerido',
            'provincia.required' => 'Provincia requerido',
            'telefono.required' => 'Teléfono requerido',
            'telefono.regex' => 'Teléfono no válido',
            'email.required' => 'Email requerido',
            'email.email' => 'Email no válido',
        ];
    }
}
