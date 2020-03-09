<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
      protected $table = 'orden';

    protected $fillable = [
       'compra_id','precio'
    ];
}
