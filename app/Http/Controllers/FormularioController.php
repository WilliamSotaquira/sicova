<?php

namespace sicova\Http\Controllers;

use Illuminate\Http\Request;

use sicova\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sicova\Http\Requests\IngresoFormRequest;

use sicova\Formulario;
use sicova\DetalleFormulario;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class FormularioController extends Controller
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
     		$formularios= DB::table('tbl_formulario')
               ->where('descripcion','LIKE','%'.$query.'%')
               ->orwhere('estado','LIKE',''.$query.'%')
     		// ->where('condicion','=','1')
     		->orderBy('idformulario','desc')
     		->paginate(7);
     		 return view('gestion.formularios.index',["formularios"=>$formularios,"searchText"=>$query]);
     	}
     } 

     #permite retornar a la vista
     public function create()
     {
        $preguntas=DB::table('tbl_pregunta as p') 
        ->select('p.idpregunta','p.pregunta')
        ->where('estado','=','1')
        ->get();   

        $formularios=DB::table('tbl_formulario as f') 
        ->select('f.idformulario','f.descripcion')
        ->where('estado','=','1')
        ->get(); 

        // $preguntas=DB::table('tbl_formulario as f')
        // ->join('tbl_detalleformulario as df','f.idformulario','=','df.tbl_formulario_idformulario')
        // ->join('tbl_pregunta as p','df.tbl_pregunta_idpregunta','=','p.idpregunta')
        // ->select('f.idformulario','f.fecha','f.descripcion','f.version','f.estado','p.idpregunta','p.pregunta','p.descripcion','p.estado')        
        // ->get();
        return view('gestion.formularios.create',["preguntas"=>$preguntas,"formularios"=>$formularios]);
     }

     #permite almacenar el objeto del modelo en la base de datos y me redirecciona al index nuevamente.
     public function store(FormlarioFormRequest $request)
     {

         try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idproveedor=$request->get('idproveedor');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->num_comprobante=$request->get('num_comprobante');
            $mytime = Carbon::now('America/Bogota');
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto='18';
            $ingreso->estado='A';
            $ingreso->save();

            $idarticulo=$request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            //recorre los articulos agregados
            $cont = 0;
            while ($cont < count($idarticulo)) {
                # code...
                $detalle = new DetalleIngreso();
                $detalle->idingreso=$ingreso->idingreso;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_compra=$precio_compra[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->save();
                $cont=$cont+1;
            }
            DB::commit();
         } catch (\Exception $e) {
            DB::rollback(); 
        }
           
        return Redirect::to('compras/ingreso');

     	$formulario=new Formulario;

     	$mytime = Carbon::now('America/Bogota');
        $formulario->fecha = $mytime->toDateTimeString();

     	$pregunta->descripcion=$request->get('descripcion');
     	$pregunta->version=$request->get('version');
     	$pregunta->estado=$request->get('estado');
     	$pregunta->save();
     	return Redirect::to('gestion/formularios');
     }

     #permite retornar una vista y envia los datos en una matriz 
     public function show($id)
     {
     	$ingreso = DB::table('ingreso as i') 
      ->join('persona as p', 'i.idproveedor','=', 'p.idpersona') ->join('detalle_ingreso as di', 'i.idingreso', '=', 'di.idingreso') 
      ->select('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado',DB::raw('sum(di.cantidad*precio_compra) as total')) 
      ->groupBy('i.idingreso', 'i.fecha_hora', 'p.nombre', 'i.tipo_comprobante', 'i.serie_comprobante', 'i.num_comprobante', 'i.impuesto', 'i.estado') 
      ->where('i.idingreso','=', $id) 
      ->first(); 

      $detalles=DB::table('detalle_ingreso as d') 
      ->join('articulo as a','d.idarticulo','=','a.idarticulo') ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta') 
      ->where('d.idingreso','=',$id) 
      ->get(); 

      return view("compras.ingreso.show", ["ingreso"=>$ingreso,"detalles"=>$detalles]); 
     }

     # #llama un formulario para modificar los datos de una categoria especifica y envia los datos en una matriz 
     public function edit($id)
     {          
     	return view("gestion.formularios.edit",["formulario"=>Formulario::findOrFail($id)]);          
     }

     #Recibe dos parametros, envia los datos a modificar y redirije la vista a el index
     public function update(FormularioFormRequest $request,$id)
     {
     	 $formulario=pregunta::findOrFail($id);
     	 $formulario->descripcion=$request->get('descripcion');
     	 $formulario->version=$request->get('version');
         $formulario->estado=$request->get('estado');
     	 $formulario->update();
     	 return Redirect::to('gestion/formularios');
     }

     #permite la destuccion de un objeto y la eliminacion en la base de datos. cambiando el estado del los registros.
     public function destroy($id)
     {
     	$formulario=Formulario::findOrFail($id);
     	$formulario->estado='0';
     	$formulario->update();
     	return Redirect::to('gestion/formularios');
     }
}
