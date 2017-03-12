<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

// Importamos los modelos
use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		// Para las claves foraneas utilizamos 
		// una sentencia para poner el valor 0
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		
		// Vamos a truncar la información, es decir,
		// vamos a eliminar lo que haya en la BBDD
		Foto::truncate();
		Album::truncate();
		Usuario::truncate();

		// $this->call('UserTableSeeder');
		//Realizamos las llamadas a los Seeder
		$this->call('UsuariosSeeder');
		$this->call('AlbumesSeeder');
		$this->call('FotosSeeder');
	}
}


