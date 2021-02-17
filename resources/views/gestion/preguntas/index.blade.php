@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			<h3>Listado de Preguntas <a href="preguntas/create"><button class="btn btn-success">Nuevo</button></a></h3>
				@include('gestion.preguntas.search')
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Pregunta</th>
						<th>Descripcion</th>
						<th>Estado</th>
						<th>Opciones</th>
					</thead>
					@foreach ($preguntas as $pre)
					<tr>
						<td>{{ $pre->idpregunta}}</td>
						<td>{{ $pre->pregunta}}</td>
						<td>{{ $pre->descripcion}}</td>
						<!--<td>{{ $pre->estado}}</td>-->
						<td>
							
							@if ($pre->estado=='1')						
							{{ $pre->estado='Activo'}}
							@else 
							{{ $pre->estado='Inactivo'}}
							@endif		

						</td>
						<td> 
							<a href="{{URL::action('PreguntaController@edit',$pre->idpregunta)}}"><button class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{$pre->idpregunta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

						</td>
					</tr>
					@include('gestion.preguntas.modal')
					@endforeach
				</table>
			</div>
			{{$preguntas->render()}}  	
		</div>
		

	</div>


@endsection