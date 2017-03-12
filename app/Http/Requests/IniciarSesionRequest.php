<?php namespace GestorImagenes\Http\Requests;
use GestorImagenes\Http\Requests\Request;

class IniciarSesionRequest extends Request {
	/**
	 * Determina si el usuario está autorizado para hacer estas peticiones
	 * @return bool
	 */
	public function authorize()
	{	// Ponemos a true ya que se está iniciando sesión.
		return true;
	}

	/**
	 * Conjunto de reglas de validación aplicadas a las peticiones
	 * @return array
	 */
	public function rules()
	{	
		return [
			'email' => 'required|email', 
			'password' => 'required',
		];
	}
}
