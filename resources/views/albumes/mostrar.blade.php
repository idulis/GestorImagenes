@extends('app')

@section('content')


@if(Session::has('Creado'))
	<div class="alert alert-success">
	<p>El álbum ha sido creado.</p>
	</div>
@endif

<div class="container-fluid">
<p><a href="/validado/albumes/crear-album" class="btn btn-primary" role="buttom">Crear Albúm</a></p>
<!-- Verificamos que el usuario tenga esos albumes -->
@if(sizeof($albumes) > 0)
	<!-- ./ hacemos un recorrido de todos los albumes del usuario -->
	@foreach($albumes as $album)
		<div class="row">	
			<div class="col-sm-6 col-md-12">		
				<div class="thumbnail">			
					<div class="caption">
					
						<h3>{{ $album->nombre}}</h3>
						<p>{{ $album->descripcion }}</p>
						<p><a href="/validado/fotos?id={{$album->id}}" class="btn btn-primary" role="buttom">Ver fotos</a></p>
					</div>
				</div>
			</div>		
		</div>
	@endforeach
@else
<!-- ./ Mensaje, si el usuario no tiene álbumes -->
<div class="alert alert-danger">
	<p>Al parecer no tienes álbumes, crea uno.</p>
</div>
@endif
</div>
@endsection
