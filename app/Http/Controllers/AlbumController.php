<?php namespace GestorImagenes\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use GestorImagenes\Http\Requests\CrearAlbumRequest;
use GestorImagenes\Album;

class AlbumController extends Controller {

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

	public function getIndex()
	{
		// Obtenemos el usuario que está validado insitu en el sistema
		// Importamos la definición de Aux
		$usuario = Auth::user();

		// Teniendo el usuario, vamos a obtener sus albumes
		$albumes = $usuario->albumes;

		// Retomamos una vista que la vamos a llamar.
		// Que le vamos a enviar un array con los albumes obtenidos
		return view('albumes.mostrar', ['albumes' => $albumes]);
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getCrearAlbum()
	{
		return view('albumes.crear-album');
	}

	public function postCrearAlbum(CrearAlbumRequest $request)
	{
		// Procedemos a la creación del album.
		// Ya que los datos nos han llegado
		$usuario = Auth::user();
		Album::create([
			'nombre' => $request->get('nombre'),
			'descripcion' => $request->get('descripcion'),
			'usuario_id' => $usuario->id
		]);
		return redirect('/validado/albumes')->with('creado', 'El Album ha sido creado');
	}

	public function getActualizarAlbum()
	{
		return 'formulario de actualizar Albums';
	}

	public function postActualizarAlbum()
	{

		return 'actualizar Album';
	}

	public function getEliminarAlbum()
	{
		return 'formulario de Eliminar Albums';
	}

	public function postEliminarAlbum()
	{

		return 'Eliminar Album';
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
