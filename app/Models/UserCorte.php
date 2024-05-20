<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCorte extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'user_corte';

    public function promocoes() {
        return $this->belongsToMany(Promocao::class, "promocaos_cortes", "promocao_id", "corte_id");
    }

    public function corte() {
        return $this->belongsTo(Cortes::class, "corte_id");
    }

    public function usuario() {
        return $this->belongsTo(BarbeariaUser::class, "barbearia_user_id");
    }

    public function agendamentos() {
        return $this->belongsToMany(Agendamento::class, "agendamentos_cortes", "user_corte_id", "agendamento_id");
    }
}
