@use(Carbon\Carbon)

<div >

 
    <div  x-data="bob" x-init="initDatePicker($refs.datepicker2)"  wire:ignore>
        <div class="mb-4">
            <x-input type="text"  x-ref="datepicker2" wire:model.live="date" label="Data" placeholder="Selecione uma data" />
        </div>
      </div>



    
      
      <div class="ml-2" wire:loading wire:target="updateDateChanged">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
      </div>
      
      @if($dateChanged)
      <h1 class="mb-3">Horários Disponíveis:</h1>
  @php 
        $specificDateFormatted = \Carbon\Carbon::parse($this->specificDate)->format('Y-m-d');
  $specificDateEntries = $this->barbeiroSelecionado->specificDates
    ->filter(function ($entry) use ($specificDateFormatted) {
        return $entry->status === 'adicionar' && \Carbon\Carbon::parse($entry->start_date)->format('Y-m-d') === $specificDateFormatted;
    });
         $intervalString = $this->barbeiroSelecionado->interval;
         $removedDates = $this->barbeiroSelecionado->specificDates()->where('status', 'remover')->get();
      list($hours, $minutes, $seconds) = explode(':', $intervalString);
      $intervalMinutes = $hours * 60 + $minutes;
  @endphp
      @php
          function isTimeBooked($currentDateTime, $horariosAgendados, $removedDates, $selectedAgendamento = null) {
              $isAgendado = false;
              foreach ($horariosAgendados as $horarioAgendado) {
                  $startHorarioAgendado = \Carbon\Carbon::parse($horarioAgendado->start_date);
                  $endHorarioAgendado = \Carbon\Carbon::parse($horarioAgendado->end_date);
  
                  if ($currentDateTime >= $startHorarioAgendado && $currentDateTime < $endHorarioAgendado) {

                    
                  if ($selectedAgendamento && $horarioAgendado->id === $selectedAgendamento->id) {
                return 'black'; // Retorna 'black' se for o agendamento selecionado
            }
            else {
                $isAgendado = true;
            }
                   
                 
                  }
              }
  
              $isRemovedDate = false;
              foreach ($removedDates as $removedDate) {
                  $startHorarioRemovido = \Carbon\Carbon::parse($removedDate->start_date);
                  $endHorarioRemovido = \Carbon\Carbon::parse($removedDate->end_date);
  
                  if ($currentDateTime >= $startHorarioRemovido && $currentDateTime < $endHorarioRemovido) {
                      $isRemovedDate = true;
                      break; // Se encontrou, não precisa continuar o loop
                  }
              }
  
              return ($isAgendado || $isRemovedDate);
          }
      @endphp
  
      @foreach($specificDateEntries as $specificDateEntry)
          @php
              $startHour = \Carbon\Carbon::parse($specificDateEntry->start_date);
              $endHour = \Carbon\Carbon::parse($specificDateEntry->end_date);
              $currentHour = clone $startHour;
          @endphp
  
          @while($currentHour < $endHour)
              @php
                  $currentDateTime = \Carbon\Carbon::parse($this->specificDate)->setTime($currentHour->hour, $currentHour->minute);
              @endphp
  
  @if(isTimeBooked($currentDateTime, $this->barbeiroSelecionado->agendamentos, $removedDates, $selectedAgendamento) === 'black')
  <x-badge label="{{ $currentHour->format('H:i') }}" black />
@elseif(isTimeBooked($currentDateTime, $this->barbeiroSelecionado->agendamentos, $removedDates, $selectedAgendamento))
  <x-badge label="{{ $currentHour->format('H:i') }}" negative />
@else
  <x-badge label="{{ $currentHour->format('H:i') }}" />
@endif
  
              @php
                  $currentHour->addMinutes($intervalMinutes);
              @endphp
          @endwhile
      @endforeach
  
     
      @foreach($this->barbeiroSelecionado->workingHours as $workingHour)
          @if($workingHour->day_of_week->name === $dayOfWeek)
              @php
                  $startHour = \Carbon\Carbon::parse($workingHour->start_hour);
                  $endHour = \Carbon\Carbon::parse($workingHour->end_hour);
                  $currentHour = clone $startHour;
              @endphp
  
              @while($currentHour < $endHour)
                  @php
                      $currentDateTime = \Carbon\Carbon::parse($this->date)->setTime($currentHour->hour, $currentHour->minute);

             

                  @endphp
  
  @if(isTimeBooked($currentDateTime, $this->barbeiroSelecionado->agendamentos, $removedDates, $selectedAgendamento) === 'black')
  <x-badge label="{{ $currentHour->format('H:i') }}" black />
@elseif(isTimeBooked($currentDateTime, $this->barbeiroSelecionado->agendamentos, $removedDates, $selectedAgendamento))
  <x-badge label="{{ $currentHour->format('H:i') }}" negative />
@else
  <x-badge label="{{ $currentHour->format('H:i') }}" />
@endif
  
                  @php
                      $currentHour->addMinutes($intervalMinutes);
                  @endphp
              @endwhile
          @endif
      @endforeach
  @endif

 
</div>
@assets 
<script  src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script  src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/plugins/minMaxTimePlugin.js" integrity="sha512-zgiWQuiK570MGitC+mVHUDLx3irm+SJgFIZRvt76V0V/7z1Ta7eyKvrYqwb7zinesTxnVwoxvpWf4tKtNyHFvA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endassets
@script
<script>
  Alpine.data('bob', () => ({
      date: '',
      
      initDatePicker(datepickerRef) {
          var enableDays = {!! json_encode($this->barbeiroSelecionado->workingHours->pluck('day_of_week')->toArray())  !!};
          var addDays = {!! $this->barbeiroSelecionado->specificDates->where("status", "adicionar")->pluck('start_date')->map(function($date) {
return \Carbon\Carbon::parse($date)->format('d-m-Y');
})->toJson() !!};

var formattedDatesJson = {!! json_encode($this->formattedDates)  !!};
var workingHours = {!! json_encode(
    $this->barbeiroSelecionado->workingHours->map(function($workingHour) {
        $startHour = \Carbon\Carbon::parse($workingHour->start_hour);
        $endHour = \Carbon\Carbon::parse($workingHour->end_hour);
        
        // Separar horas, minutos e segundos do intervalo
        $intervalParts = explode(':', $this->barbeiroSelecionado->interval);
        
        // Verifica se o intervalo tem todas as partes necessárias
        if (count($intervalParts) === 3) {
            // Adiciona horas, minutos e segundos separadamente
            $endHour->subHours($intervalParts[0]);
            $endHour->subMinutes($intervalParts[1]);
            $endHour->subSeconds($intervalParts[2]);
        } else {
            // Lida com o caso em que o intervalo não está no formato esperado
            // Aqui, apenas definimos $endHour para null
            $endHour = null;
        }
        
        return [
            'day' => $workingHour->day_of_week->value,  
            'minTime' => $workingHour->start_hour,
            'maxTime' => $endHour ? $endHour->format('H:i') : null,
        ];
    })
) !!};
var removeDays = {!! $this->barbeiroSelecionado->specificDates->where("status", "remover")->pluck('start_date')->map(function($date) {
return \Carbon\Carbon::parse($date)->format('d-m-Y');
})->toJson() !!};

   
    


       
          
          var plugins = [];


          flatpickr(datepickerRef, {
              enableTime: true,
              dateFormat: 'd-m-Y H:i',
              inline: true,
              defaultDate: @json($date),
       
              
          
              minuteIncrement: 30,
              locale: 'pt',
      
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
        
   
            if (!addDays.includes(dateStr.split(' ')[0])) {
                var selectedWorkingHours = workingHours.find(function (hour) {
                    return hour.day === dayOfWeek;
                });
            
                if (selectedWorkingHours) {
               
                    instance.set('minTime', selectedWorkingHours.minTime);
             
                    instance.set('maxTime', selectedWorkingHours.maxTime);
                }
            } else {
                instance.set('minTime', null); 
                instance.set('maxTime', null);
            }
            
        
            
        }


  


              
     
          });
      }
  }));


</script>
@endscript