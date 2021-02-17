<?php

namespace sicova\Http\Controllers;

use Illuminate\Http\Request;

use sicova\Http\Requests; 
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sicova\Http\Requests\PreguntaFormRequest;
use sicova\Pregunta;
use DB;

/*El controlador es el encargado de trabajar asociando las peticiones con los metodos: 

GET: index, create, show, edit.
POST: store.
PUT: update.
DELETE: destroy.
PATCH: uptade.

*/

class PreguntaController extends Controller
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
     		$preguntas= DB::table('tbl_pregunta')
               ->where('pregunta','LIKE','%'.$query.'%')
               ->orwhere('estado','LIKE',''.$query.'%')
     		// ->where('condicion','=','1')
     		->orderBy('idpregunta','desc')
     		->paginate(7);
     		 return view('gestion.preguntas.index',["preguntas"=>$preguntas,"searchText"=>$query]);
     	}
     } 

     #permite retornar a la vista
     public function create()
     {
     	return view('gestion.preguntas.create');
     }

     #permite almacenar el objeto del modelo en la base de datos y me redirecciona al index nuevamente.
     public function store(PreguntaFormRequest $request)
     {
     	$pregunta=new Pregunta;
     	$pregunta->pregunta=$request->get('pregunta');
     	$pregunta->descripcion=$request->get('descripcion');
     	$pregunta->estado=$request->get('estado');
     	$pregunta->save();
     	return Redirect::to('gestion/preguntas');
     }

     #permite retornar una vista y envia los datos en una matriz 
     public function show($id)
     {
     	return view("gestion.preguntas.show",["pregunta"=>pregunta::findOrFail($id)]);
     }

     # #llama un formulario para modificar los datos de una categoria especifica y envia los datos en una matriz 
     public function edit($id)
     {          
     	return view("gestion.preguntas.edit",["pregunta"=>Pregunta::findOrFail($id)]);          
     }

     #Recibe dos parametros, envia los datos a modificar y redirije la vista a el index
     public function update(preguntaFormRequest $request,$id)
     {
     	 $pregunta=pregunta::findOrFail($id);
     	 $pregunta->pregunta=$request->get('pregunta');
     	 $pregunta->descripcion=$request->get('descripcion');
           $pregunta->estado=$request->get('estado');
     	 $pregunta->update();
     	 return Redirect::to('gestion/preguntas');
     }

     #permite la destuccion de un objeto y la eliminacion en la base de datos. cambiando el estado del los registros.
     public function destroy($id)
     {
     	$pregunta=pregunta::findOrFail($id);
     	$pregunta->estado='0';
     	$pregunta->update();
     	return Redirect::to('gestion/preguntas');
     }
}
