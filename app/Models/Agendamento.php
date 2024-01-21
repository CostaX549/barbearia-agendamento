<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;


    public function barbeiro(){
         return $this->belongsTo(Barbeiros::class,"barbeiro_id");
    }

    public function cortes() {
        return $this->belongsToMany(Cortes::class, "agendamentos_cortes", "agendamento_id", "corte_id");
    }

    public function user(){
         return $this->belongsTo(User::class,"user_id");
    }
}
