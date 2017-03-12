@extends('app')

@section('content')
<!-- Primer caso, cuando el usuario no está validado, mostramos un errorerror -->
@if (Session::has('error'))
	<div class="alert alert-danger">
	<strong>Whoops!</strong> Al parecer algo está mal.<br><br>
	{{Session::get('error')}}
@endif

<!-- Muestra un texto que todo ha ido bien -->
@if (Session::has('actualizado'))
	<div class="alert alert-success">
	<strong>Yes!</strong> Todo ha ido bien.<br><br>
	{{Session::get('actualizado')}}
@endif

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Inicio</div>

				<div class="panel-body">
					Bienvenido {{Auth::user()->nombre}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
