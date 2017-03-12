<?php namespace GestorImagenes\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
//vendor\laravel\framework\src\Illuminate\Session\TokenMismatchException.php:
use Illuminate\Session\TokenMismatchException;



class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 * Guarda en un archivo logs los errores
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * Muestra los errores de dicho archivo log
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		// Preguntamos si $e es una instancia de Token...
		if ($e instanceof TokenMismatchException)
		{
			// vamos a redireccionar a la URL de donde se produjo el error. Y un mensaje
			return redirect($request->url())->with('csrf','Al parecer pasó mucho tiempo, intenta de nuevo');
		}
		// según la definición de render, utiliza el valor de la variable: config('app.debug')
		if(config('app.debug'))
		{
			// permitimos el renderizado de esa excepción.
			return parent::render($request, $e);
		}
		// Cuando el usuario no ingresa los datos correctos
		// Sino vamos a realizar una redirección al lugar de INICIO de la web.
		// mandanto un mensaje dicidieno 'error' que diga los siguiente.
		return redirect('/')->with('error','Algo salió mal...');
	}
}
