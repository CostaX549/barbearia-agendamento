<?php

namespace App\Livewire;

use App\Models\Barbearia;

use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Livewire\Component;

class Gerenciar extends Component
{
    public $types = ['food', 'shopping', 'entertainment', 'travel', 'other'];

    public $colors = [
        'food' => '#f6ad55',
        'shopping' => '#fc8181',
        'entertainment' => '#90cdf4',
        'travel' => '#66DA26',
        'other' => '#cbd5e0',
    ];

    public $firstRun = true;

    public $barbearia;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
        'onBlockClick' => 'handleOnBlockClick',
    ];

    public function mount($slug) {
              $this->barbearia = Barbearia::where('slug', $slug)->firstOrFail();
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
        $expenses = [
            ['type' => 'food', 'amount' => 500],
            ['type' => 'shopping', 'amount' => 300],
            ['type' => 'entertainment', 'amount' => 200],
            ['type' => 'travel', 'amount' => 100],
            ['type' => 'other', 'amount' => 50],
        ];
    
        $columnChartModel = collect($expenses)
            ->groupBy('type')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()['type'];
                $value = collect($data)->sum('amount');
    
                return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Expenses by Type')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
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
                ->setAnimated($this->firstRun)
                ->setType('donut')
                ->withOnSliceClickEvent('onSliceClick')
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
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
                ->setAnimated($this->firstRun)
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
                ->setAnimated($this->firstRun)
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
            ->setAnimated($this->firstRun)
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
                ->setAnimated($this->firstRun)
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
                ->setAnimated($this->firstRun)
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