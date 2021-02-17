<?php

namespace sicova\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*
    Permite validar los datos enviados enviados en un formulario.
*/

class SedeFormRequest extends FormRequest
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
            'nombre_sede'=>'required|max:45',
            'direccion_sede'=>'required|max:45',
        ];
    }
}
