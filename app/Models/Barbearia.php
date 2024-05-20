<?php

namespace App\Models;

use App\Enums\PaymentMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Barbearia extends Model
{
    use HasFactory;
  

    protected $casts = [
        'galeria' => 'array',
        'redes_sociais' => 'array',
        'payment_method' => PaymentMethods::class,
        
    ];

    
public function owner() {
    return $this->belongsTo(User::class, "owner_id");
}

    public function barbeiros(){
        return $this->hasMany(BarbeariaUser::class, "barbearia_id");
    }

    public function estoques() {
        return $this->hasMany(Estoque::class, "barbearia_id");
    }



    public function caixas(){
          return $this->hasMany(Barbearia::class,"barbeiro_id");
    }

    public function avaliacoes(){
       return  $this->hasMany(Avaliacao::class,"barbearia_id");
}

 public function cortes(){
    return  $this->hasMany(Cortes::class,"barbearia_id");
 }

public function isBarberShopClosed()
{
    // Obtém o dia da semana atual (0 para domingo, 1 para segunda-feira, etc.)
    $currentDayOfWeek = Carbon::now()->dayOfWeek;

    // Obtém os horários de trabalho dos barbeiros para o dia da semana atual
    $workingHours = $this->barbeiros()->with(['workingHours' => function ($query) use ($currentDayOfWeek) {
        $query->where('day_of_week', $currentDayOfWeek);
    }])->get()->pluck('workingHours')->flatten();

    // Obtém as datas específicas dos barbeiros
    $specificDates = $this->barbeiros()->with('specificDates')->get()->pluck('specificDates')->flatten();

    $now = Carbon::now();

    // Verifica se a barbearia está fechada com base nos horários de trabalho para o dia da semana atual
    foreach ($workingHours as $workingHour) {
        $startTime = Carbon::parse($workingHour->start_hour);
        $endTime = Carbon::parse($workingHour->end_hour);
        
        if ($now->format('H:i') >= $startTime && $now->format('H:i') <= $endTime) {
            return false; // A barbearia está aberta durante este horário de trabalho
        }
    }

    // Verifica se a barbearia está fechada com base nas datas específicas
    foreach ($specificDates as $specificDate) {
        $startDate = Carbon::parse($specificDate->start_date);
        $endDate = Carbon::parse($specificDate->end_date);
        
        if ($now >= $startDate && $now <= $endDate) {
            return false; // A barbearia está fechada devido a uma data específica
        }
    }

    return true; // Se nenhum horário de trabalho ou data específica corresponder ao momento atual, a barbearia está fechada
}

public function respostas(){
    return   $this->hasMany(Resposta::class,"barbearia_id");
}
    public function clientes(){
        return   $this->hasMany(Cliente::class,"barbearia_id");
    }

    public function promocoes() {
        return $this->hasMany(Promocao::class);
    }

    public function compras(){
         return $this->hasMany(Compras::class,"barbearia_id", "compra_id");
    }

   
}
