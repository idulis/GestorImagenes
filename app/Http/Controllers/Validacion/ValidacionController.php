<?php namespace GestorImagenes\Http\Controllers\Validacion;

use GestorImagenes\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use GestorImagenes\Http\Requests\IniciarSesionRequest;

use GestorImagenes\Http\Requests\RecuperarContrasenaRequest;
use GestorImagenes\Usuario;

use Validator;
use Auth;

class ValidacionController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getSalida']);
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegistro()
	{
		return view('validacion.registro');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegistro(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}
		Auth::login($this->create($request->all()));

		return redirect($this->redirectPath());
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getInicio()
	{
		return view('validacion.inicio');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postInicio(IniciarSesionRequest $request)
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}
		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
		return 'Email o contraseña no válido';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getSalida()
	{
		Auth::logout();

		return redirect('/');
	}

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/inicio';
	}

	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/validacion/inicio';
	}


	public function getRecuperar()
	{
		return view('validacion.recuperar');
	}

	public function postRecuperar(RecuperarContrasenaRequest $request)
	{
		// Extraemos los datos de la BBDD
		$pregunta = $request->get('pregunta');
		$respuesta = $request->get('respuesta');
		$email = $request->get('email');
		$usuario = Usuario::where('email', '=', $email)->first();

		// Verificamos los datos extraidos con los dados por el usuario
		if($pregunta === $usuario->pregunta && $respuesta === $usuario->respuesta)
		{
			$contrasena = $request->get('password');
			$usuario->password = bcrypt($contrasena);

			//Guardamos
			$usuario->save();

			return redirect('/validacion/inicio')->with(['recuperada' => 'La contraseña se cambió. Iniciar Sesión']);
		}
		return redirect('/validacion/recuperar')->withInput($request->only('email', 'pregunta'))->withErrors(['pregunta' => 'La pregunta y/o respuesta no coinciden.']);
	}
	
	/**
	 * Muestra un error, cuando el usuarios escribe una ruta que existe
	 *
	 * @return string
	 */
	public function missingMethod($parameters = array())
	{
		abort(404);
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'nombre' => 'required|max:255',
			'email' => 'required|email|max:255|unique:usuarios', // tabla usuarios
			'password' => 'required|confirmed|min:6',
			'pregunta' => 'required|max:255',
			'respuesta' => 'required|max:255'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return Usuario::create([
			'nombre' => $data['nombre'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'pregunta' => $data['pregunta'],
			'respuesta' => $data['respuesta']
		]);
	}
}
