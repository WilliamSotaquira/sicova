@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Formularios <a href="formularios/create"><button class="btn btn-success">Nuevo</button></a></h3>
				@include('gestion.formularios.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Fecha</th>
						<th>Version</th>
						<th>Descripcion</th>
						<th>Estado</th>
						<th>Opciones</th>
						
					</thead>
					@foreach ($formularios as $for)
					<tr>
						<td>{{ $for->fecha}}</td>
						<td>{{ $for->descripcion}}</td>
						<td>{{ $for->version}}</td>
						<td>

							@if ($for->estado=='1')						
							{{ $for->estado='Activo'}}
							@else 
							{{ $for->estado='Inactivo'}}
							@endif	

						</td>							

						<td>  
							<a href="{{URL::action('FormularioController@show',$for->idformulario)}}"><button class="btn btn-primary">Detalles</button></a>
							<a href="" data-target="#modal-delete-{{$for->idformulario}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
						</td>
					</tr>
					@include('gestion.formularios.modal')
					@endforeach
				</table>
			</div>
			{{$formularios->render()}}  	
		</div>
		

	</div>




@endsection