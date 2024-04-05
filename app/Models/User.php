<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Customer\CustomerCardClient;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password',
        'provider_avatar', 'provider_id',
        'provider_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
       
    ];


    public function barbeariasOwned(){
         return $this->hasMany(Barbearia::class,"owner_id");
    }

    public function barbeariasWorking() {
        return $this->belongsToMany(Barbearia::class, "barbearia_users", "user_id", "barbearia_id");
    }


    public function workingHours() {
        return $this->hasMany(UserWorkingHours::class, "user_id");
    }
   public function cortes(){
        return $this->belongsToMany(Cortes::class,"user_corte","user_id","corte_id");
   }

    public function specificDates() {
        return $this->hasMany(SpecificDate::class, "user_id");
    }

    public function getMercadoPagoCards()
    {
        try {
          
            MercadoPagoConfig::setAccessToken("TEST-8752356059637759-013112-141508c4f33f8637c374126ff1fc0586-1660752433");
            
            
            $client = new CustomerCardClient();
            
         if($this->payer_id) {

       
            $resposta = $client->list($this->payer_id);
            $cards = $resposta->data;
        } else {
            $cards = [];
        }
            
            return $cards;
        } catch (\Exception $e) {
            // Se ocorrer uma exceção, capture-a e retorne null
            dd($e);
            return null;
        }
    }



   
     

    public function eventos(){
         return $this->hasMany(Agendamento::class,"owner_id");
    }


 

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    public function avaliacoes(){
        return   $this->hasMany(Avaliacao::class,"user_id");
    }
}
