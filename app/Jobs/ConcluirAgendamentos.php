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
         
              
    if ($agendamento->payment_method == 'Cartão de Crédito' && isset($agendamento->maquininha->taxa_credito)) {
        $agendamento->fatura_price = $agendamento->total_price - ($agendamento->maquininha->taxa_credito/100 * $agendamento->total_price);
       
    } elseif($agendamento->payment_method == 'Cartão de Débito' && isset($agendamento->maquininha->taxa_debito)) {
        $agendamento->fatura_price = $agendamento->total_price - ($agendamento->maquininha->taxa_debito/100 * $agendamento->total_price);
    } else {
       $agendamento->fatura_price = $agendamento->total_price;
    }
             
               $agendamento->save();
               $cliente = Cliente::where('user_id', $agendamento->owner_id)->first();
               if(!$cliente) {
                 $cliente = new Cliente();
                 $cliente->user_id = $agendamento->owner_id;
                 $cliente->barbearia_id = $agendamento->barbeiros()->first()->barbearia->id;
                  $cliente->save();
               }
         
          

            $agendamento->delete();

            
        }
    }
}
