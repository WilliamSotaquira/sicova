<?php

namespace sicova;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    /*
		El modelo es el encargdo de gestional las tablas de las bases de datos;
	*/

    protected $table='tbl_sede';
    protected $primaryKey='idsede';
    public $timestamps=false;

    protected $filleble=[
    	'nombre_sede',
    	'direccion_sede',
    	'estado_sede',

    ];
    protected $guarded =[
    	
    ];
}
