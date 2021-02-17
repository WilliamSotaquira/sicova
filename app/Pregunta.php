<?php

namespace sicova;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
	/*
		El modelo es el encargdo de gestional las tablas de las bases de datos;
	*/

    protected $table='tbl_pregunta';
    protected $primaryKey='idpregunta';
    public $timestamps=false;

    protected $filleble=[
        'idpregunta',
    	'pregunta',
    	'descripcion',
    	'estado',

    ];
    protected $guarded =[
    	
    ];
}
