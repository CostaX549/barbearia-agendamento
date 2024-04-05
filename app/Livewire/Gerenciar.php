<?php

namespace App\Livewire;

use App\Models\Barbearia;
use App\Models\Agendamento;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Plan;
use Livewire\Attributes\Computed;

class Gerenciar extends Component
{



    public $barbearia;
    public $agendamentos;
    public $showDataLabels = false;
     public $agendamentosPorMes;
     public $type;
     public int $agendamentosHoje = 0;
         


    public function mount($slug) {
     
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
  
    
    
        
    }



   #[Computed]
     public function usersToday(){
                  foreach($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro){
                     
             $this->agendamentosHoje += $barbeiro->agendamentos()->onlyTrashed()->whereDate("deleted_at", Carbon::now()->format('Y-m-d'))->pluck("owner_id")->unique()->count();
                  }
             

     

              return $this->agendamentosHoje;
     }



     #[Computed]
       public function usersPorcentagem(){
          $agendamentosSemanaPassada = 0;
        foreach($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro){
                         $agendamentosSemanaPassada += $barbeiro->agendamentos()->onlyTrashed()->whereDate("deleted_at", Carbon::now()->subDays(7)->format('Y-m-d'))->pluck("owner_id")->unique()->count();
        }
                         $diferenca = $this->agendamentosHoje - $agendamentosSemanaPassada;

                       
                         $porcentagemAumento = ($agendamentosSemanaPassada != 0) ? ($diferenca / $agendamentosSemanaPassada ) * 100 : 0;
                     
                         return $porcentagemAumento;

                   
       }


       #[Computed]
public function usersLastQuarterComparison() {
  
    $dataAtualInicio = Carbon::now()->startOfQuarter();
    $dataAtualFim = Carbon::now();
    $dataPassadaInicio = $dataAtualInicio->copy()->subQuarter();
    $dataPassadaFim = $dataAtualFim->copy()->subQuarter();


    $usuariosUltimoTrimestreAtual = $this->getTotalUsuariosAgendados($dataAtualInicio, $dataAtualFim);


    $usuariosTrimestrePassado = $this->getTotalUsuariosAgendados($dataPassadaInicio, $dataPassadaFim);


    $diferenca = $usuariosUltimoTrimestreAtual - $usuariosTrimestrePassado;

  
    $porcentagemAumento = ($usuariosTrimestrePassado != 0) ? ($diferenca / $usuariosTrimestrePassado) * 100 : 0;

    return [
        'usuarios_ultimo_trimestre_atual' => $usuariosUltimoTrimestreAtual,
       
        'porcentagem_aumento' => $porcentagemAumento
    ];
}

private function getTotalUsuariosAgendados($inicio, $fim) {
    $totalUsuarios = 0;

    foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
        
        $totalUsuarios += $barbeiro->agendamentos()
        ->onlyTrashed()
        ->where('deleted_at', '>=', $inicio)
        ->where('deleted_at', '<=', $fim)
        ->pluck('owner_id')
        ->unique()
        ->count();
    }
    return $totalUsuarios;
}


#[Computed]
    public function totalhoje()
    {
        $totalHoje = 0;
    
        foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
            $agendamentos = $barbeiro->agendamentos()->onlyTrashed()->whereDate('deleted_at', today())->get();
    
            foreach ($agendamentos as $agendamento) {
                foreach ($agendamento->cortes as $corte) {
                    $totalHoje += $corte->corte->preco;
                }
            }
        }
    
        return $totalHoje;
    }
    #[Computed]
    public function diferencapercentual() {
        $ontem = Carbon::yesterday();
        $totalOntem = 0;
        
        // Calcular total de ontem
        foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
            $agendamentos = $barbeiro->agendamentos()->onlyTrashed()->whereDate('deleted_at', $ontem)->get();
    
            foreach ($agendamentos as $agendamento) {
                foreach ($agendamento->cortes as $corte) {
                    $totalOntem += $corte->corte->preco;
                }
            }
        }
        
        // Verificar se $totalOntem é zero
        if ($totalOntem == 0) {
            return "0";
        }
        
        // Calcular diferença percentual
        $diferenca = $this->totalhoje - $totalOntem;
        $diferencaPercentual = ($diferenca / $totalOntem) * 100;
    
        return number_format($diferencaPercentual, 2);
    }

    #[Computed]
    public function totalMes()
    {
        
        $primeiroDiaDoMes = now()->startOfMonth();
        $ultimoDiaDoMes = now()->endOfMonth();
    
        // Obter o primeiro e o último dia do mês anterior
        $primeiroDiaMesAnterior = now()->subMonth()->startOfMonth();
        $ultimoDiaMesAnterior = now()->subMonth()->endOfMonth();
    
      
        $totalMesAtual = $this->calcularTotalMes($primeiroDiaDoMes, $ultimoDiaDoMes);
    

        $totalMesAnterior = $this->calcularTotalMes($primeiroDiaMesAnterior, $ultimoDiaMesAnterior);
    
 
        $diferenca = $totalMesAtual - $totalMesAnterior;
     

     
        $percentualDiferenca = ($totalMesAnterior != 0) ? ($diferenca / $totalMesAnterior) * 100 : 0;

        
        return [
            'total_mes_atual' => $totalMesAtual,
            'total_mes_anterior' => $totalMesAnterior,
            'diferenca' => $percentualDiferenca
        ];
    }
    
    private function calcularTotalMes($primeiroDia, $ultimoDia)
    {
        $totalMes = 0;
    
        foreach ($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro) {
            $totalMes += $barbeiro->agendamentos()
                ->onlyTrashed()
                ->whereBetween('deleted_at', [$primeiroDia, $ultimoDia])
                ->with('cortes')
                ->get()
                ->flatMap(function ($agendamento) {
                    return $agendamento->cortes->pluck('corte.preco');
                })
                ->sum();
        }
    
        return $totalMes;
    }

    public function render()

    {  
      
    
        return view('livewire.gerenciar')
        ->layout('components.layouts.barbearia', [
                'barbearia' => $this->barbearia,
            ]);
    }
}