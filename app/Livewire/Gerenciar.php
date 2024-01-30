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
class Gerenciar extends Component
{


    public $colors = [
        'janeiro' => '#000000',
        'fevereiro' => '#fc8181',
        'março' => '#90cdf4',
        'abril' => '#66DA26',
        'maio' => '#cbd5e0',
        'junho' => '#f6ad55',
        'julho' => '#fc8181',
        'agosto' => '#90cdf4',
        'setembro' => '#66DA26',
        'outubro' => '#cbd5e0',
        'novembro' => '#cbd5e0',
        'dezembro' => '#cbd5e0',
    ];

    public $firstRun = true;

    public $barbearia;
    public $agendamentos;
    public $showDataLabels = false;
     public $agendamentosPorMes;
     public $type;
          public $anosDesdeCriacao = [];
    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];

    public function mount($slug) {
        $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
        $this->type = Carbon::now()->year;
    
        // Carrega os relacionamentos
        $anoCriacao = $this->barbearia->created_at->year;

            $anoAtual = Carbon::now()->year;

           
    for ($ano = $anoCriacao; $ano <= $anoAtual; $ano++) {
        $this->anosDesdeCriacao[] = $ano;
    }
    
        // Você pode retornar $agendamentosPorMes ou fazer qualquer outra coisa com ele
        
    }



    public function handleOnPointClick($point)
    {
        dd($point);
    }

    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }

    public function handleOnColumnClick($column)
    {
        dd($column);
    }

    public function handleOnBlockClick($block)
    {
        dd($block);
    }

    public function render()

    {  
        $anoAtual = $this->type;
    
       
        $agendamentosPorMes = [];
    
        for ($mes = 1; $mes <= 12; $mes++) {
            // Filtra os agendamentos pelo mês e ano
            $agendamentosDoMes = $this->barbearia->barbeiros->flatMap(function ($barbeiro) use ($mes, $anoAtual) {
                return $barbeiro->agendamentos->filter(function ($agendamento) use ($mes, $anoAtual) {
                    $start_date = Carbon::parse($agendamento->start_date);
                    return $start_date->format('m') == $mes && $start_date->format('Y') == $anoAtual;
                });
            });
    
            // Armazena o número de agendamentos para o mês atual
            $agendamentosPorMes[$mes] = $agendamentosDoMes->count();
        }
                   
        $expenses = [];
       // Agora você precisa adicionar cada mês com o número correto de agendamentos
       for ($mes = 1; $mes <= 12; $mes++) {
        $nomeMes = Carbon::createFromDate(null, $mes, 1)->locale('pt_BR')->isoFormat('MMMM');
        $expenses[] = ['type' => $nomeMes, 'amount' => $agendamentosPorMes[$mes]];
    }
   
    
        $columnChartModel = collect($expenses)
            ->groupBy('type')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()['type'];
                $value = collect($data)->sum('amount');
    
                return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Expenses by Type')
                ->setAnimated($this->type)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(true)
                ->setDataLabelsEnabled($this->showDataLabels)
               
                ->setColumnWidth(90)
                ->withGrid()
            );
    
        $pieChartModel = collect($expenses)
            ->groupBy('type')
            ->reduce(function ($pieChartModel, $data) {
                $type = $data->first()['type'];
                $value = collect($data)->sum('amount');
    
                return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
            }, LivewireCharts::pieChartModel()
                ->setAnimated($this->type)
                ->setType('donut')
                ->withOnSliceClickEvent('onSliceClick')
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                
            );
    
            $lineChartModel = collect($expenses)->reduce(function ($lineChartModel, $data, $index) {
                $amountSum = collect($data)->take($index + 1)->sum('amount');
            
                if ($index == 6) {
                    $lineChartModel->addMarker(7, $amountSum);
                }
            
                if ($index == 11) {
                    $lineChartModel->addMarker(12, $amountSum);
                }
            
                return $lineChartModel->addPoint($index, $data['amount'], ['id' => $index]);
            }, LivewireCharts::lineChartModel()
                ->setAnimated($this->type)
                ->withOnPointClickEvent('onPointClick')
                ->setSmoothCurve()
                ->setXAxisVisible(true)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->sparklined()
            );
    
            $areaChartModel = collect($expenses)
            ->reduce(function ($areaChartModel, $data, $index) {
                return $areaChartModel->addPoint($index, $data['amount'], ['id' => $index]);
            }, LivewireCharts::areaChartModel()
                ->setAnimated($this->type)
                ->setColor('#f6ad55')
                ->withOnPointClickEvent('onAreaPointClick')
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setXAxisVisible(true)
                ->sparklined()
        );
    
        $multiLineChartModel = collect($expenses)
        ->reduce(function ($multiLineChartModel, $data, $index) {
            return $multiLineChartModel
                ->addSeriesPoint($data['type'], $index, $data['amount'], ['id' => $index]);
        }, LivewireCharts::multiLineChartModel()
            ->setAnimated($this->type)
            ->withOnPointClickEvent('onPointClick')
            ->setSmoothCurve()
            ->multiLine()
            ->setDataLabelsEnabled($this->showDataLabels)
            ->sparklined()
            ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
    );
    
        $multiColumnChartModel = collect($expenses)
            ->groupBy('type')
            ->reduce(function ($multiColumnChartModel, $data) {
                $type = $data->first()['type'];
    
                return $multiColumnChartModel
                    ->addSeriesColumn($type, 1, collect($data)->sum('amount'));
            }, LivewireCharts::multiColumnChartModel()
                ->setAnimated($this->type)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->withOnColumnClickEventName('onColumnClick')
                ->setTitle('Revenue per Year (K)')
                ->stacked()
                ->withGrid()
            );
    
        $radarChartModel = collect($expenses)
            ->reduce(function (RadarChartModel $radarChartModel, $data) {
                return $radarChartModel->addSeries($data['type'], $data['type'], $data['amount']);
            }, LivewireCharts::radarChartModel()
                ->setAnimated($this->firstRun)
            );
    
        $treeChartModel = collect($expenses)
            ->groupBy('type')
            ->reduce(function (TreeMapChartModel $chartModel, $data) {
                $type = $data->first()['type'];
                $value = collect($data)->sum('amount');
    
                return $chartModel->addBlock($type, $value)->addColor($this->colors[$type]);
            }, LivewireCharts::treeMapChartModel()
                ->setTitle('Expenses Weight')
                ->setAnimated($this->type)
                ->setDistributed(true)
                ->withOnBlockClickEvent('onBlockClick')
            );
    
        $this->firstRun = false;
    
        return view('livewire.gerenciar')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
                'lineChartModel' => $lineChartModel,
                'areaChartModel' => $areaChartModel,
                'multiLineChartModel' => $multiLineChartModel,
                'multiColumnChartModel' => $multiColumnChartModel,
                'radarChartModel' => $radarChartModel,
                'treeChartModel' => $treeChartModel,
            ])
            ->layout('components.layouts.barbearia', [
                'barbearia' => $this->barbearia,
            ]);
    }
}