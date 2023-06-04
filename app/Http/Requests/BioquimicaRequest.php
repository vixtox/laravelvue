<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BioquimicaRequest extends FormRequest
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
            'urea' => ['nullable'],
            'creatinina' => ['nullable'],
            'glucosa' => ['nullable'],
            'proteinas' => ['nullable'],
            'albumina' => ['nullable'],
            'bilirrubina' => ['nullable'],
            'alp' => ['nullable'],
            'gpt' => ['nullable'],
            'fosforo' => ['nullable'],
            'calcio' => ['nullable'],
            'colesterol' => ['nullable'],
            'trigliceridos' => ['nullable'],
            'lipidos' => ['nullable'],
            'cpk' => ['nullable'],
            'amilasa' => ['nullable'],
            'lipasa' => ['nullable'],
            'sodio' => ['nullable'],
            'potasio' => ['nullable'],
            'cloro' => ['nullable'],
            't4' => ['nullable'],
            'fecha' => ['required'],
            'animal' => ['required'],
            'mascotas_id' => ['required'],
            'visita_id' => ['required']
        ];
    }

}
