<?php namespace GestorImagenes\Http\Controllers;

class BienvenidaController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('bienvenida');
		//return 'bienvenida a la aplicacion';
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
