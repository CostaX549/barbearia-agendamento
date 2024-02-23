<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Agendamento;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
          $users = User::all();
          
          foreach($users as $user){
               $agendamentos = Agendamento::where("user_id",$user->id)->get();
               Log::info(Carbon::now());
        
               foreach($agendamentos as $agendamento){
                Log::info('Iniciando o job de notificação...');
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $agendamento->start_date);
                $now = Carbon::now();
                Log::info('agendamento');
                if ($start_date->diffInMinutes($now) <= 60) {
                    
                    $firebaseToken = $agendamento->user->token;
                    $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $agendamento->start_date);
                    $start_date_formatted = $start_date->format('d/m/Y H:i'); 
                    if ($user->id == $agendamento->user->id) {
                  Http::withHeaders([
                       'Content-Type' => 'application/json',
                       'Authorization' => 'Bearer ya29.a0AfB_byBHwem8zeKAky1rz80dKDOC-WAwDQ6jUXaAgKW1n_7MdtfwccBlOBZyKAxJxMPKmQyhopPlTRFNWti2K83hwwUd8qiXQD_xstNK4JXwv8dvCB9Mx8Q5LR-y14rASnyzWX18hmBj4oxuQamKptlg1uIndu8K649wNQaCgYKAWISARMSFQHGX2Mig_ewXEFcz2dC2nHMF7cHmw0173'
                   ])->post('https://fcm.googleapis.com/v1/projects/barbearia-agendamento-7fe43/messages:send', [
                       "message" => [
                           "token" => $firebaseToken,
                           "notification" => [
                               "title" => "Falta uma Hora para o seu corte !",
                               "body" => "Data: ". $start_date_formatted,
                               "image" => "http://localhost/storage/" . $agendamento->barbeiro->barbearia->imagem
                           ],
                           "webpush" => [
                               "fcm_options" => [
                                   "link" => "http://localhost/home"
                               ]
                           ]
                       ]
                   ]);
                }
            }
               }
          }
    }
}
