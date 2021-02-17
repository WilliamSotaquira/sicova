<?php

namespace sicova;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{

	/*
		El modelo es el encargdo de gestional las tablas de las bases de datos;
	*/
		
    protected $table='tbl_ambiente';
    protected $primaryKey='idambiente';
    public $timestamps=false;

    protected $fillable = [
    	'idambiente',
    	'nombre_ambiente',
    	'estado_ambiente',
    	'sede',
    	'descripcion',


    ];
}
