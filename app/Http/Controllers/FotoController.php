<?php 
namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\MostrarFotosRequest;
use GestorImagenes\Http\Requests\CrearFotoRequest;

use Illuminate\Http\Request;

use GestorImagenes\Album;
use GestorImagenes\Foto;

use Carbon\Carbon;

class FotoController extends Controller {

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

	public function getIndex(MostrarFotosRequest $request)
	{
		// id de album 
		$id = $request->get('id');

		// Obtenemos las fotos de ese album $id
		$fotos = Album::find($id)->fotos;

		//Retorna una vista llamada: fotos.mostrar y
		// enviamos el array con las fotos
		return view('fotos.mostrar', ['fotos' => $fotos, 'id' => $id]);

	}

	/**
	 * Debemos saber el $id 
	 * del album a la que vaya a pertenecer, la foto.
	 * Y el encargado de enviarnos ese $id, es el getIndex
	 *
	 * @return Response
	 */
	public function getCrearFoto(Request $request)
	{
		// enviado desde el getindex el $id
		$id = $request->get('id');
		return view('fotos.crear-foto', ['id' => $id]);
	}

	public function postCrearFoto(CrearFotoRequest $request)
	{
		// Recibimos los siguientes parámetros
		$id = $request->get('id'); 
		$imagen = $request->file('imagen');
		$ruta = '/img/';
		$nombre = sha1(Carbon::now()).'.'.$imagen->guessExtension();
		$imagen->move(getcwd().$ruta, $nombre);

		// Vamos a crear la foto
		Foto::create
		(
			[
				'nombre' => $request->get('nombre'),
				'descripcion' => $request->get('descripcion'),
				'ruta' => $ruta.$nombre,
				'album_id' => $id
			]
		);

		return redirect("/validado/fotos?id=$id")->with('Creada','La foto ha sido subida');
	}

	public function getActualizarFoto()
	{
		return 'formulario de actualizar fotos';
	}

	public function postActualizarFoto()
	{

		return 'actualizar foto';
	}

	public function getEliminarFoto()
	{
		return 'formulario de Eliminar fotos';
	}

	public function postEliminarFoto()
	{

		return 'Eliminar foto';
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
