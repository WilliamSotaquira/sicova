@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3>Nuevo Formulario </h3>
      @if (count($errors)>0)
       <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>
            {{$error}}
          </li>
          @endforeach
        </ul>
       </div>
       @endif
    </div>
  </div>     

       {!!Form::open(array('url'=>'gestion/formularios','method'=>'POST','autocomplete'=>'off'))!!}
       {{Form::token()}}

<div class="row">
  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    <div class="form-group">
        <label for="descripcion">Descripcion </label>
        <input type="text" name="descripcion" class="form-control" placeholder="Descripcion...">
    </div>
  </div>
  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
    <div class="form-group">
        <label for="version">Version </label>
        <input type="text" name="version" class="form-control" placeholder="Version...">
    </div>
  </div>
  <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">   
    <div class="form-group">
          <label>Estado</label>
          <select name="estado" class="form-control selectpiker" data-live-search="true" id="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>   
          </select>          
    </div>
  </div>
</div>

<div class="row">
  <div class="panel panel-primary" >
    <div class="panel-body">

      <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
          <div class="form-group">
            <label for="idpregunta">Id Pregunta</label>
            <p>{{$preguntas->idpregunta}}</p>            
          </div>          
        </div>

      <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
        <div class="form-group">
            <label>Preguntas</label> 
            <select name="pidpregunta" id="pidpregunta" class="form-control selectpicker" data-live-search="true">
              @foreach($preguntas as $pregunta)
              <option value="{{$pregunta->idpregunta}}">{{$pregunta->pregunta}}</option>
              @endforeach
            </select> 
        </div>
      </div>
      <label>-</label> 
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          
            <button class="btn btn-primary" type="button" id="bt_add"> Agregar </button>   
        </div>          
      </div>

       

      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="table-responsive">
          <table id="detalles" class="table table-striped table-bordered table-responsed table-hover">
            <thead style="background-color:#A9D0F5 ">
              <th>Opciones</th>
              <th>Nro Pregunta</th>
              <th>Pregunta</th>              
              <th>Descripcion</th>
              <th>Estado</th>                        
            </thead>

            <tbody>              
            </tbody>
              
            <tfoot>
              <th>Sicova</th>
              <th></th>
         
              <th></th>
              <th></th>
              <th></th>             
            </tfoot>
            <tbody>
              
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">     
    <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-primary" type="submit">Guardar </button>   
        <button class="btn btn-danger" type="reset">Cancelar </button>      
    </div>
  </div>
</div>
{!!Form::close()!!} 


@push ('scripts')
<script>

  $(document).ready(function(){
    $('#bt_add').click(function(){
    agregar();
    });
  });

  var cont=0;
  $("#guardar").hide();

  function agregar()
 {
    idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_venta=$("#pprecio_venta").val();

    if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
    {
       subtotal[cont]=(cantidad*precio_compra);
       total=total+subtotal[cont];

       var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
       cont++;
       limpiar();
       $('#total').html("$/ " + total);
       evaluar();
       $('#detalles').append(fila);

    }
    else
    {
      alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
    }
  }
  function evaluar(){
    if (total>0)
    {
      $("#guardar").show();
    }
    else
    {
      $("#guardar").hide(); 
    }
   }
  function limpiar(){
    
  }
  function eliminar(index){
  total=total-subtotal[index]; 
    $("#total").html("S/. " + total);   
    $("#fila" + index).remove();
    evaluar();
 }



</script>
@endpush
@endsection