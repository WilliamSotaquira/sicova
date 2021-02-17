<?php

namespace sicova\Http\Controllers;

use Illuminate\Http\Request;

use sicova\Http\Requests; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sicova\Http\Requests\SedeFormRequest;
use sicova\Sede;
use DB;

/*El controlador es el encargado de trabajar asociando las peticiones con los metodos: 

GET: index, create, show, edit.
POST: store.
PUT: update.
DELETE: destroy.
PATCH: uptade.

*/

class SedeController extends Controller
{
	 #	
     public function __construct()
     {

     }

     #permite visualizar la paina principal
     public function index(Request $request)     
     {
     	if ($request)
     	{
     		$query=trim($request->get('searchText'));
     		$sedes= DB::table('sede')
               ->where('nombre_sede','LIKE','%'.$query.'%')
               ->where('estado_sede','=','1')
     		->orderBy('idsede','desc')
     		->paginate(7);
     		 return view('gestion.sedes.index',["sedes"=>$sedes,"searchText"=>$query]);
     	}
     } 

     #permite retornar a la vista
     public function create()
     {
     	return view('gestion.sedes.create');
     }

     #permite almacenar el objeto del modelo en la base de datos y me redirecciona al index nuevamente.
     public function store(SedeFormRequest $request)
     {
     	$sedes=new Sede;
     	$sedes->nombre_sede=$request->get('nombre_sede');
     	$sedes->direccion_sede=$request->get('direccion_sede');
     	$sedes->estado_sede='1';
     	$sedes->save();
     	return Redirect::to('gestion/sedes');
     }

     #permite retornar una vista y envia los datos en una matriz 
     public function show($id)
     {
     	return view("gestion.sedes.show",["sedes"=>Sede::findOrFail($id)]);
     }

     # #llama un formulario para modificar los datos de una categoria especifica y envia los datos en una matriz 
     public function edit($id)
     {
     	return view("gestion.sedes.edit",["sedes"=>Sede::findOrFail($id)]);
     }

     #Recibe dos parametros, envia los datos a modificar y redirije la vista a el index
     public function update(SedeFormRequest $request,$id)
     {
     	 $sedes=sede::findOrFail($id);
     	 $sedes->nombre_sede=$request->get('nombre_sede');
     	 $sedes->direccion_sede=$request->get('direccion_sede');
     	 $sedes->update();
     	 return Redirect::to('gestion/sedes');
     }

     #permite la destuccion de un objeto y la eliminacion en la base de datos. cambiando el estado del los registros.
     public function destroy($id)
     {
     	$sedes=Sede::findOrFail($id);
     	$sedes->estado_sede='0';
     	$sedes->update();
     	return Redirect::to('gestion/sedes');
     }
}
