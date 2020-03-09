<?php

use Illuminate\Database\Seeder;
use App\Categoria;


class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = new Categoria;
		$categorias->nombre = 'kubo_cateria1';
		$categorias->save();

		$categorias = new Categoria;
		$categorias->nombre = 'kubo_cateria2';
		$categorias->save();

		$categorias = new Categoria;
		$categorias->nombre = 'kubo_cateria3';
		$categorias->save();

		$categorias = new Categoria;
		$categorias->nombre = 'kubo_cateria4';
		$categorias->save();

		$categorias = new Categoria;
		$categorias->nombre = 'kubo_cateria4';
		$categorias->save();
    }
}
