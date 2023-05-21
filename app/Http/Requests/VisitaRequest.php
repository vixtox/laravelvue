<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitaRequest extends FormRequest
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
            'fecha_visita' => ['required'],
            'hora_visita' => ['nullable'],
            'veterinario' => ['required'],
            'sintomas' => ['required'],
            'diagnostico' => ['required'],
            'tratamiento' => ['required'],
            'coste' => ['required'],
            'mascotas_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'fecha_visita.required' => 'Fecha visita requerida',
            'hora_visita' =>  'nullable',
            'veterinario.required' => 'Veterinario  requerido',
            'sintomas.required' => 'Síntomas  requeridos',
            'diagnostico.required' => 'Diagnóstico  requerido',
            'tratamiento.required' => 'Tratamiento requerido',
            'coste.required' => 'Coste  requerido',
            'mascotas_id' => 'nullable'
        ];
    }

}
