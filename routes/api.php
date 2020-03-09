<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/productos','CarritoController@Productos');
Route::get('/verproducto/{id}','CarritoController@VerProductos');
Route::post('/shop','CarritoController@AgregarCarrito');

///categorias
Route::get('/categorias','CarritoController@ListaCategoria');
Route::get('/filtro/{cat}','CarritoController@FiltroCategoria');
