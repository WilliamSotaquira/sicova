<?php

namespace sicova\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
    Permite validar los datos enviados enviados en un formulario.
*/

class PreguntaFormRequest extends FormRequest
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
     *Establece las reglas de validacion de los datos.
     * @return array
     */
    public function rules()
    {
        return [
            'pregunta'=>'required|max:225',
            'descripcion'=>'max:500',
            'estado'=>'required',

        ];
    }
}
