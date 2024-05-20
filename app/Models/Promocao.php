<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    use HasFactory;

    public function cortes() {
        return $this->belongsToMany(Cortes::class, "promocao_cortes", "promocao_id", "corte_id");
    }

    public function clientes(){
        return $this->belongsToMany(Cortes::class, "cliente_cortes", " cliente_id", " promocao_id");
    }
}
