<?php

namespace sicova;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    /*
		El modelo es el encargdo de gestional las tablas de las bases de datos;
	*/

    protected $table='tbl_formulario';
    protected $primaryKey='idformulario';
    public $timestamps=false;

    protected $filleble=[
      
        'idformulario',
        'fecha',
    	'descripcion',
        'version',
    	'estado',

    ];
    protected $guarded =[
    	
    ];
}
