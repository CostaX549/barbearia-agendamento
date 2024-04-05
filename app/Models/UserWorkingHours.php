<?php

namespace App\Models;

use App\Enums\DaysOfWeek;
use App\Enums\DiasDaSemana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkingHours extends Model
{

    protected $fillable = [
     'barbearia_user_id',
     'day_of_week',
     'start_hour',
     'end_hour',
     'intervals'
    ];

    protected $casts = [
        'intervals' => 'array',
        'specific_dates'=>'array',
        'day_of_week' => DaysOfWeek::class
    ];
    


    
    use HasFactory;
}
