@extends('app')

@section('content')
<div class="container-fluid">
<!-- ./ estamos recibiendo el $id del album a la cual se va a asociar dicha foto -->
<p><a href="/validado/fotos/crear-foto?id={{$id}}" class="btn btn-primary" role="buttom">Crear Foto</a></p>
<!-- Verificamos que el usuario tenga esos fotos -->
@if(sizeof($fotos) > 0)
	<!-- ./ hacemos un recorrido de todos los fotos del usuario -->
	@foreach($fotos as $foto)
		<div class="row">	
			<div class="col-sm-6 col-md-12">		
				<div class="thumbnail">			
					<img src="{{$foto->ruta}}">
					<div class="caption">
						<h3>{{ $foto->nombre}}</h3>
						<p>{{ $foto->descripcion }}</p>
					</div>
				</div>
			</div>		
		</div>
	@endforeach
@else
<!-- ./ Mensaje, si el usuario no tiene álbumes -->
<div class="alert alert-danger">
	<p>Al parecer este albúm no tiene fotos, crea uno.</p>
</div>
@endif
</div>
@endsection


