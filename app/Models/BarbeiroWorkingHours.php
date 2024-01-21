<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarbeiroWorkingHours extends Model
{

    protected $fillable = [
     'barbeiro_id',
     'day_of_week',
     'start_hour',
     'end_hour'
    ];

    protected $casts = [
        'intervals' => 'array',
    ];
    
    use HasFactory;
}
