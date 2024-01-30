<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;


    public function user(){
         return $this->belongsTo(User::class,"user_id");
    }

    public function barbearia(){
         return $this->belongsTo(Barbearia::class,"barbearia_id");
    }
}
