@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Sedes <a href="sedes/create"><button class="btn btn-success">Nuevo</button></a></h3>
				@include('gestion.sedes.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>IdSede</th>
						<th>Nombre Sede</th>
						<th>Direccion Sede</th>
						<th>Opciones</th>
					</thead>
					@foreach ($sedes as $sed)
					<tr>
						<td>{{ $sed->idsede}}</td>
						<td>{{ $sed->nombre_sede}}</td>
						<td>{{ $sed->direccion_sede}}</td>
						<td> 
							<a href="{{URL::action('SedeController@edit',$sed->idsede)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$sed->idsede}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

						</td>
					</tr>
					@include('gestion.sedes.modal')
					@endforeach
				</table>
			</div>
			{{$sedes->render()}}  	
		</div>
		

	</div>


@endsection