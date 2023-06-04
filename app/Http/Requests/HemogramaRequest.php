<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HemogramaRequest extends FormRequest
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
            'hematocrito' => ['required'],
            'hemoglobina' => ['required'],
            'g_rojo' => ['required'],
            'vcm' => ['required'],
            'hcm' => ['required'],
            'chcm' => ['required'],
            'reticulocitos' => ['required'],
            'eosinofilos' => ['required'],
            'linfocitos' => ['required'],
            'monocitos' => ['required'],
            'leucocitos' => ['required'],
            'plaquetas' => ['required'],
            'fecha' => ['required'],
            'animal' => ['required'],
            'mascotas_id' => ['required'],
            'visita_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'hematocrito.required' => 'Hematocrito requerido',
            'hemoglobina.required' => 'Hemoglobina requerido',
            'g_rojo.required' => 'Globulos rojos requerido',
            'vcm.required' => 'VCM requerido',
            'hcm.required' => 'HCM requerido',
            'chcm.required' => 'CHCM requerido',
            'reticulocitos.required' => 'Reticulocitos requerido',
            'eosinofilos.required' => 'Eosinofilos requerido',
            'linfocitos.required' => 'Linfocitos requerido',
            'monocitos.required' => 'Monocitos requerido',
            'leucocitos.required' => 'Leucocitos requerido',
            'plaquetas.required' => 'Plaquetas requerido',
            'fecha.required' => 'Fecha requerida',
            'animal.required' => 'Animal requerido',
            'mascotas_id.required' => 'Mascotas_id requerida',
            'visita_id.required' => 'Visita_id requerida',
        ];
    }
}
