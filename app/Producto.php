<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
   protected $fillable = [
        'titulo', 'descripcion', 'precio','imagenes',
    ];

     public function scopeCategoria($query, $cat)
    {
        return $query->where('categoria_id', $cat);
    }
}
