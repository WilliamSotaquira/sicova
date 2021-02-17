@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sede: {{ $sedes->nombre_sede}}</h3>

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

			 {!!Form::model($sedes,['method'=>'PATCH','route'=>['sedes.update',$sedes->idsede]])!!}
			 {{Form::token()}}

			 <div class="form-group">
			 	<label for="nombre_sede">Nombre Sede</label>
			 	<input type="text" name="nombre_sede" class="form-control" value="{{$sedes->nombre_sede }}" placeholder="Nombre Sede...">
			 </div>

			 <div class="form-group">
			 	<label for="direccion_sede">Direccion Sede</label>
			 	<input type="text" name="direccion_sede" class="form-control" value="{{$sedes->direccion_sede }}" placeholder="Direccion Sede...">
			 </div>
			 
			 <div class="form-group">
			 	<button class="btn btn-primary" type="submit">Guardar </button>		
			 	<button class="btn btn-danger" type="reset">Cancelar </button>		 	
			 </div>

			 {!!Form::close()!!}

		</div>
	</div>

@endsection