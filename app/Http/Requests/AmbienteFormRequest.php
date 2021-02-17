<?php

namespace sicova\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbienteFormRequest extends FormRequest
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
            'idsede'=>'required',
            'nombre_ambiente'=>'required|max:45',
            'estado_ambiente'=>'required|numeric',
            'descripcion'=>'max:250',
            'imagen'=>'mimes:jpeg,bmp,png'
        ];
    }
}
