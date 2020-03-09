<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = new Producto;
		$productos->titulo = 'kubo_producto1';
		$productos->categoria_id = '1';
		$productos->descripcion = 'descripcion del producto1';
		$productos->precio = '55000';
		$productos->imagenes = 'http://lorempixel.com/output/food-q-c-640-480-2.jpg';
		$productos->save();

		$productos = new Producto;
		$productos->titulo = 'kubo_producto2';
		$productos->categoria_id = '2';
		$productos->descripcion = 'descripcion del producto2';
		$productos->precio = '25000';
		$productos->imagenes = 'http://lorempixel.com/output/food-q-c-640-480-2.jpg';
		$productos->save();

		$productos = new Producto;
		$productos->titulo = 'kubo_producto3';
		$productos->categoria_id = '3';
		$productos->descripcion = 'descripcion del producto3';
		$productos->precio = '50000';
		$productos->imagenes = 'http://lorempixel.com/output/food-q-c-640-480-2.jpg';
		$productos->save();

		$productos = new Producto;
		$productos->titulo = 'kubo_producto4';
		$productos->categoria_id = '4';
		$productos->descripcion = 'descripcion del producto4';
		$productos->precio = '45000';
		$productos->imagenes = 'http://lorempixel.com/output/food-q-c-640-480-2.jpg';
		$productos->save();


		$productos = new Producto;
		$productos->titulo = 'kubo_producto5';
		$productos->categoria_id = '5';
		$productos->descripcion = 'descripcion del producto5';
		$productos->precio = '5000';
		$productos->imagenes = 'http://lorempixel.com/output/food-q-c-640-480-2.jpg';
		$productos->save();
    }
}
