<?php

namespace App\Jobs;

use App\Models\Agendamento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Faturas;
use App\Models\Cliente;


class ConcluirAgendamentos implements ShouldQueue
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

        //Lógica para geração de faturas
        $agendamentos = Agendamento::where('end_date', '<=', now())->get();

        foreach($agendamentos as $agendamento) {
         
            foreach($agendamento->barbearia as $index => $maquina){
                if (isset($agendamento->barbearia->faturas[$index])) {
                    
                    $faturas = $agendamento->barbearia->faturas[$index];
                    
                  
                    foreach ($faturas as $metodo => $percentual) {
                       
                        if ($metodo == $agendamento->paymentMethod) {

                                   $precoFinal =  $agendamento->price*($agendamento->price * $percentual/100);
                           
                        }
                    }
                }
              }
              $agendamento->fatura_price = $precoFinal;
               $agendamento->save();
               $cliente = new Cliente();
               $cliente->user_id = $agendamento->owner_id;
               $cliente->barbearia_id = $agendamento->barbearia->id;
                $cliente->save();
         
          

            $agendamento->delete();

            
        }
    }
}
