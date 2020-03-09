<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';

  protected $fillable = [
       'id_compra','producto_id','cantidad'
    ];

}
