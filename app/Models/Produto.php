<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public function estoque(){
         return $this->belongsTo(Estoque::class, "estoque_id");
    }
}
