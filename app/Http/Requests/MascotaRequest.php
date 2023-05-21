<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MascotaRequest extends FormRequest
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
            'nombre' => ['required', 'min:3', 'max:50'],
            'chip' => ['nullable'],
            'capa' => ['nullable'],
            'caracter' => ['nullable'],
            'sexo' => ['required'],
            'estado' => ['required'],
            'fecha_nacimiento' => ['nullable'],
            'fecha_baja' => ['nullable'],
            'causa_baja' => ['nullable'],
            'cliente_id' => ['required'],
            'especie_id' => ['required'],
            'razas_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Nombre requerido',
            'nombre.min' => 'Minimo 3 caracteres',
            'nombre.max' => 'Máximo 50 caracteres',
            'chip' => 'nullable',
            'capa' => 'nullable',
            'caracter' => 'nullable',
            'sexo.required' => 'Sexo requerido',
            'estado.required' => 'Estado requerido',
            'fecha_nacimiento' => 'required',
            'fecha_baja' => 'nullable',
            'causa_baja' => 'nullable',
            'cliente_id.required' => 'Propietario requerido',
            'especie_id.required' => 'Especie requerida',
            'razas_id.required' => 'Raza requerida',
        ];
    }

}
