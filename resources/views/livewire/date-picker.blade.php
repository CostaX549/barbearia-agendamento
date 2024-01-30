@use(Carbon\Carbon)

<div>
 
 
    <div x-data="bob" x-init="initDatePicker($refs.datepicker2)" wire:ignore>
        <div class="mb-4">
            <x-input type="text"  x-ref="datepicker2" wire:model.live="date" label="Data" placeholder="Selecione uma data" />
        </div>
      </div>
   
    
      
      <div class="ml-2" wire:loading wire:target="date">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
      </div>
      
      @if($date)
      <h1 class="mb-3">Horários Disponíveis:</h1>
      

 


@php
 
  $specificDateFormatted = \Carbon\Carbon::parse($this->specificDate)->format('Y-m-d');


$specificDateEntry = $this->barbeiroSelecionado->specificDates->filter(function ($entry) use ($specificDateFormatted) {
    $startDate = \Carbon\Carbon::parse($entry->start_date)->format('Y-m-d');
    return $startDate == $specificDateFormatted;
})->first();
    if ($specificDateEntry) {
        // Definição inicial da data de início
        $horariosAgendados = $this->barbeiroSelecionado->agendamentos->flatMap(function ($agendamento) {
            $start = Carbon::parse($agendamento->start_date);
            $end = Carbon::parse($agendamento->end_date);
        
            $horarios = [];
            while ($start < $end) {
                $horarios[] = $start->format('Y-m-d H:i');
                $start->addHour(); // Ajuste o intervalo conforme necessário
            }
        
            return $horarios;
        })->toArray();
        $startDateCarbon = \Carbon\Carbon::parse($this->specificDate);
    
        
        $startDateAdd = \Carbon\Carbon::parse($specificDateEntry->start_date);
        $endDate = $specificDateEntry->end_date;
        $endDateCarbon = \Carbon\Carbon::parse($endDate);
    }
@endphp

@if($specificDateEntry)
    @while($startDateAdd->lt($endDateCarbon))
        @php
            $hour = $startDateAdd->format('H:i');
            $hourlyTimes[] = $hour;
            $dates[] = $startDateAdd->format('Y-m-d');

            $intervalString = $this->barbeiroSelecionado->interval;


list($hours, $minutes, $seconds) = explode(':', $intervalString);
$intervalMinutes = $hours * 60 + $minutes;

$interval = new DateInterval("PT{$hours}H{$minutes}M{$seconds}S");
        @endphp
    
        @php
  
            $dateTime = $startDateAdd->format('Y-m-d H:i');
            $currentDateTime = Carbon::parse($dateTime);
            $isAgendado = false;
            foreach ($horariosAgendados as $agendado) {
                $startHorarioAgendado = Carbon::parse($agendado);
                $endHorarioAgendado = $startHorarioAgendado->copy()->addMinutes($intervalMinutes); 
            
                if ($currentDateTime->between($startHorarioAgendado, $endHorarioAgendado)) {
                    $isAgendado = true;
                    break;
                }
            }
        @endphp
    
        @if($isAgendado)
            <x-badge label="{{ $hour }}" negative />
        @else
            <x-badge label="{{ $hour }}" />
        @endif
    
        @php
            $startDateAdd->add($interval);
        @endphp
    @endwhile
    
@endif
        @php
        // Obtenha todos os horários agendados no formato 'Y-m-d H:i'
        $horariosAgendados = $this->barbeiroSelecionado->agendamentos->flatMap(function ($agendamento) {
            $start = Carbon::parse($agendamento->start_date);
            $end = Carbon::parse($agendamento->end_date);
      
            $horarios = [];
            while ($start < $end) {
                $horarios[] = $start->format('Y-m-d H:i');
                $start->addHour(); // Ajuste o intervalo conforme necessário
            }
      
            return $horarios;
        })->toArray();
      @endphp
      
      @foreach($this->barbeiroSelecionado->workingHours as $workingHour)
      @if($workingHour->day_of_week === $dayOfWeek)
      @php
          $startHour = new DateTime($workingHour->start_hour);
          $endHour = new DateTime($workingHour->end_hour);
  
          // Converter o intervalo de agendamento para minutos
          list($hours, $minutes, $seconds) = explode(':', $this->barbeiroSelecionado->interval);
          $intervalMinutes = $hours * 60 + $minutes;
  
          $currentHour = clone $startHour;
      @endphp
  
      @while($currentHour < $endHour)
          @php
              $currentDateTime = Carbon::parse($this->date)->setTime($currentHour->format('H'), $currentHour->format('i'));
  
              $isAgendado = false;
foreach ($horariosAgendados as $horarioAgendado) {
    $startHorarioAgendado = Carbon::parse($horarioAgendado);
    $endHorarioAgendado = $startHorarioAgendado->copy()->addMinutes($intervalMinutes); // Adiciona o intervalo ao horário agendado

    // Verifica se $currentDateTime está entre $startHorarioAgendado e $endHorarioAgendado
    if ($currentDateTime->between($startHorarioAgendado, $endHorarioAgendado)) {
        $isAgendado = true;
        break; // Se encontrou, não precisa continuar o loop
    }
}
          @endphp
  
          @if($isAgendado)
              <x-badge label="{{ $currentHour->format('H:i') }}" negative />
          @else
              <x-badge label="{{ $currentHour->format('H:i') }}" />
          @endif
  
          @php
              $currentHour->add(new DateInterval("PT{$intervalMinutes}M"));
          @endphp
      @endwhile
  @endif
      @endforeach
@endif
 

 
</div>
@script
<script>
  Alpine.data('bob', () => ({
      date: '',
      
      initDatePicker(datepickerRef) {
          var enableDays = {!! json_encode($this->barbeiroSelecionado->workingHours->pluck('dia_numero')->toArray())  !!};
          var addDays = {!! $this->barbeiroSelecionado->specificDates->where("status", "adicionar")->pluck('start_date')->map(function($date) {
return \Carbon\Carbon::parse($date)->format('d-m-Y');
})->toJson() !!};

var formattedDatesJson = {!! json_encode($this->formattedDates)  !!};

var removeDays = {!! $this->barbeiroSelecionado->specificDates->where("status", "remover")->pluck('start_date')->map(function($date) {
return \Carbon\Carbon::parse($date)->format('d-m-Y');
})->toJson() !!};

          var workingHours = {!! json_encode(
              $this->barbeiroSelecionado->workingHours->map(function($workingHour) {
                  return [
                      'day' => $workingHour->dia_numero,  
                      'minTime' => $workingHour->start_hour,
                      'maxTime' => $workingHour->end_hour,
                  ];
              })
          ) !!};

          var specificHours = {!! json_encode(
              $this->barbeiroSelecionado->specificDates->map(function($specificDates) {
                  return [
                      'day' => \Carbon\Carbon::parse($specificDates->start_date)->dayOfWeek,
                      'minTime' => $specificDates->start_date,
                      'maxTime' => $specificDates->end_date,
                  ];
              })
          ) !!};


          var bookedDates = {!! json_encode(
              $this->barbeiroSelecionado->agendamentos->pluck("start_date")
                  ->map(function($date) {
                      return \Carbon\Carbon::parse($date)->format('d-m-Y H:i');
                  })
                  ->toArray()
          ) !!};
          
          var plugins = [];

if (formattedDatesJson !== null) {
    plugins.push(new minMaxTimePlugin({
        table: formattedDatesJson
    }));
}
          flatpickr(datepickerRef, {
              enableTime: true,
              dateFormat: 'd-m-Y H:i',
              inline: true,
              defaultDate: @json($date),
       
              plugins: plugins,
          
              minuteIncrement: 30,
              locale: 'pt',
              defaultHour: 13,
              minDate: 'today',


               enable: [
  function (date) {
      var date = new Date(date);
      var formattedDate = ("0" + date.getDate()).slice(-2) + '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getFullYear();
        
     
   
  
      if (addDays.includes(formattedDate)) {
          return true;
      }

      // Verifica se a data está em enableDays (dias permitidos)
      return enableDays.includes(date.getDay());
  }
],      




  


              
              onChange: function (selectedDates, dateStr, instance) {
            
 
    var selectedDate = selectedDates[0];
    var dayOfWeek = selectedDate.getDay();



    var selectedWorkingHours = workingHours.find(function (hour) {
        return hour.day === dayOfWeek;
    });



    if (selectedWorkingHours) {
   
        instance.set('minTime', selectedWorkingHours.minTime);
 
        instance.set('maxTime', selectedWorkingHours.maxTime);
    }
    

    
}
          });
      }
  }));


</script>
@endscript