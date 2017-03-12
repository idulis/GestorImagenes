<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\EditarPerfilRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return 'página de usuario validado';
	}

	public function getEditarPerfil()
	{	// llamamos al fichero: resourse
		return view('usuario.actualizar');
	}

	public function postEditarPerfil(EditarPerfilRequest $request)
	{
		// debemo importar la definición de Auth
		$usuario = Auth::user(); // usuario de la sesión actal
		$nombre = $request->get('nombre'); // obtenemos su nombre

		$usuario->nombre = $nombre;

		// Si la petición tiene una password
		if($request->has('password'))
		{
			$usuario->password = bcrypt($request->get('password'));
		}

		// Si la pregunta tiene una respuesta
		if($request->has('pregunta'))
		{
			$usuario->pregunta = $request->get('pregunta');
			$usuario->respuesta = $request->get('respuesta');
		}

		// Guardamos los datos del usuario
		$usuario->save();

		return redirect('/validado')->with('actualizado', 'Su perfil ha sido actualizado');
	}
	/**
	 * Muestra un error, cuando el usuarios escribe una ruta por error
	 *
	 * @return string
	 */
	public function missingMethod($parameters = array())
	{
		abort(404);
	}
}