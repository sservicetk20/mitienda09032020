<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Producto;
use App\Ordenes;
use App\Compras;

class CarritoController extends Controller
{
    //prueba kubo.co listar productos
    public function Productos(){
        $productos = Producto::all();
        return $productos;
    }
    //interna producto
    public function VerProductos($id){
        $producto = Producto::find($id);
        return $producto;
    }
    //agregar al carrito 
    public function AgregarCarrito(Request $request){
        // obtener un array con pedido
        $pedido = $request->input("pedidos");

        //return $pedido;
        
        foreach (json_decode($pedido) as $item){

            //return $item->id;

            $Compras = new Compras(array(
              'id_compra'=> uniqid(),
              'producto_id' => $item->id,
              'cantidad' => $item->cant
            ));

            $Compras->save();
            
        }

       $Ordenes = Ordenes::create([
         'compra_id' => $Compras['id_compra'],
         'precio' => $request->input("total")
        ]);

    
    }

    public function ListaCategoria(){
        $Categoria = Categoria::all();
        return $Categoria;
    }

    public function FiltroCategoria($cat){
        $filtro = Producto::Categoria($cat)->get();
        return $filtro;
    }
}
