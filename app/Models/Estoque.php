<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    

    public function produtos(){
        return $this->hasMany(Produto::class, "estoque_id");
   }

} 
