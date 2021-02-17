<?php

namespace sicova\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormularioFormRequest extends FormRequest
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
            
            'descripcion'=>'required|max:500',
            'version'=>'required|max:45',            
            'estado'=>'required',
            'tbl_formulario_idformulario'=>'required',
            'tbl_pregunta_idpregunta'=>'required',



        ];
    }
}
