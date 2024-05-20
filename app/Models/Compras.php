<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;


    public function produtos(){
              return $this->belongsToMany(Produto::class, "compras_produto","compra_id","produto_id");
    }
}
