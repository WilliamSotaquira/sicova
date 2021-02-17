@extends ('layouts.admin')
@section ('contenido')

  <div class="row">

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <div class="form-group">
        <label for="descripcion">Descripcion</label>
       <p>{{$formulario->descripcion}}</p>
       </div>   
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="version">Version</label>
        <p>{{$formulario->version}}</p>
      </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
      <div class="form-group">
        <label for="estado">Estado </label>
        <p>{{$formulario->estado}}</p>
       </div>
    </div>
</div>

  <div class="row">
    <div class="panel panel-primary">
      <div class="panel-body">

         <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-responsed table-hover">
                  <thead style="background-color:#A9D0F5 ">
                 
                    <th>Id</th>
                    <th>Pregunta</th>           
                  </thead>                  
                  <tfoot>
                 
                    <th></th>
                    <th></th>
                              
                  </tfoot>
                  <tbody>
                    @foreach($detalles as $det)
                    <tr>
                      <td>{{$det->articulo}}</td>
                      <td>{{$det->cantidad}}</td>
                      
                    </tr>
                    @endforeach
                    
                  </tbody>
                  
              </table>
            </div>
          </div>
        </div>      
      </div>   
      
@endsection