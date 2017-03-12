<?php
/*
|------------------------------------------------------
| Rutas a aplicaciones
|------------------------------------------------------
| Aquí podemos registrar toda las rutas para una aplicación.
| Simplemente dicirle a Laravel las URIs que debería responder 
| y para llamar y darle al controlardor cuando la URI es solicitada
|
| es decir cuando en la URI contenga la palabra fotos va a ejecutar el
| controlador FotoController.
*/
Route::controllers([
	// Ruta coincide con la ruta del controlador, 
	// para que nos permita ejectar sus acciones.
	'validacion' => 'Validacion\ValidacionController', 	
	// Rutas con las que vamos a interactuar con sus 
	// acciones, para usuarios validado
	'validado/albumes'	=>	'AlbumController',			 
	'validado/fotos'	=>	'FotoController',			
	'validado/usuario'	=>	'UsuarioController',		
	// Ruta para la ejecución de acciones para usuario 
	// que ya se han validado.
	'validado'	=>	'InicioController',					
	// Ruta para la página de inicio, donde el usuario 
	// aún no ha iniciado sesión.
	'/'	=>	'BienvenidaController'
]);


