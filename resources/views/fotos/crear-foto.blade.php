@extends('app')

@section('content')
<div class="container-fluid">
		<!-- ./ cambio: action="" -->
		<form class="form-horizontal" role="form" method="POST" action="/validado/fotos/crear-foto?id={{$id}}" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
						<div class="form-group required required">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<!-- ./ cambio: value = value: para mantener lo escrito por el usuario. -->
								<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Descripción</label>
							<div class="col-md-6">
								<!-- ./ cambio: value = para mantener lo escrito por el usuario. -->
								<textarea type="text" class="form-control" name="descripcion" row="3" required>{{ old('descripcion') }}</textarea>
							</div>
						</div>

						<div class="form-group required">
							<label class="col-md-4 control-label">Imagen max: 20MB</label>
							<div class="col-md-6">
								<!-- ./ cambio: value = para mantener lo escrito por el usuario. -->
								<input type="file" class="form-control" name="imagen" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Subir Imagen
								</button>
							</div>
						</div>
					</form>

</div>
@endsection
