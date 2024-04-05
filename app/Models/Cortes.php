<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cortes extends Model
{
    use HasFactory;


    public function barbeiro(){
         return $this->belongsTo(Barbeiros::class,"barbeiro_id");
    }

    public function agendamentos() {
        return $this->belongsToMany(Agendamento::class, "agendamentos_cortes", "user_corte_id", "agendamento_id");
    }
    
}
