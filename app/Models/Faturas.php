<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faturas extends Model
{
    use HasFactory;
    
   public function agendamento() {
    return $this->belongsTo(Agendamento::class, "agendamento_id")->onlyTrashed();
   }
}
