<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cortes extends Model
{
    use HasFactory;


   

    public function agendamentos() {
        return $this->belongsToMany(Agendamento::class, "agendamentos_cortes", "user_corte_id", "agendamento_id");
    }

   
    public function promocoes() {
        return $this->belongsToMany(Promocao::class, "promocaos_cortes", "corte_id", "promocao_id");
    }
    
}
