<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;



    public function barbearia(){
           return $this->belongsTo(Barbearia::class, "barbearia_id");

    }
    public function  user(){
        return $this->belongsTo(User::class, "user_id");
        
 }

 public function agendamentos() {
       // Verificar se o cliente tem um user_id definido
       if ($this->user_id) {
       
           return $this->hasMany(Agendamento::class, "owner_id", "user_id");
       } else {
         
           return $this->hasMany(Agendamento::class, 'cliente_id');
       }
   }

   public function promocoes(){
    return $this->belongsToMany(Promocao::class, "cliente_promocoes","cliente_id","promocao_id");
}
}
