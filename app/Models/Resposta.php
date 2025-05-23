<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    use HasFactory;

    public function barbearia() {
        return $this->belongsTo(Barbearia::class, "barbearia_id");
    }
}
