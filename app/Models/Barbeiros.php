<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbeiros extends Model
{
    use HasFactory;


    public function workingHours() {
        return $this->hasMany(BarbeiroWorkingHours::class, "barbeiro_id");
    }

    public function agendamentos(){
       return  $this->hasMany(Agendamento::class,"barbeiro_id");
    }

    public function barbearia() {
        return $this->belongsTo(Barbearia::class, "barbearia_id");
    }

    public function cortes(){
         return $this->hasMany(Cortes::class,"barbeiro_id");
    }
}
