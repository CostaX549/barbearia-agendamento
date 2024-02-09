<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;

class Barbearia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'galeria' => 'array',
    ];

    
public function owner() {
    return $this->belongsTo(User::class, "owner_id");
}
public function barbeiros() {
    return $this->hasMany(Barbeiros::class, "barbearia_id");
}
    public function users(){
        return $this->belongsToMany(User::class,"barbearia_users","barbearia_id","user_id");
    }



    public function caixas(){
          return $this->hasMany(Barbearia::class,"barbeiro_id");
    }

    public function avaliacoes(){
       return  $this->hasMany(Avaliacao::class,"barbearia_id");
}
    
}
