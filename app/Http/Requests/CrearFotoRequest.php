<?php namespace GestorImagenes\Http\Requests;

use GestorImagenes\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;
use GestorImagenes\Album;


class CrearFotoRequest extends Request {
	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize()
	{
		// Recibimos el usuario validado
		$user = Auth::user();

		// Vamos a buscar por el id
		$id = $this->get('id');

		// Buscamos el album que se corresponda con el ID
		$album = $user->albumes()->find($id);

		// entonces si este album existe 
		if($album)
		{
			return true;
		}
			return false;
	}
	/**
	 * Get the validation rules that apply to the request.
	 * @return array
	 */
	public function rules()
	{
		return [
			'id' => 'required|exists:albumes,id',
			'nombre' => 'required',
			'descripcion' => 'required',
			'imagen' => 'required|image|max:20000'
		];
	}
}


