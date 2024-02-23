<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{  protected $fillable = [
    'barbearia_id',
    'user_id',
    
   ];
    use HasFactory;
}
