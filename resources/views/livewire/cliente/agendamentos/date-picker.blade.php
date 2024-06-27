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
      <p class="text-neutral-800  mb-2">
      Horários Disponíveis:
      </p>
      @foreach ($this->barbeiroSelecionado->getAllAvailableTimes($this->date, $this->selectedAgendamento) as $time)

    @php

        $color = $time['color'];
    @endphp
    @if ($color === 'red')
        <x-badge label="{{ $time['time']->format('H:i') }}" negative />
    @elseif($color === '')
    <x-badge label="{!! $time['time']->format('H:i') !!}" x-on:click="$wire.setDate('{{ $time['time']->format('H:i') }}')" />
    @else
    <x-badge  label="{{ $time['time']->format('H:i') }}" black />
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
var maxDate = {!! json_encode($barbeiroSelecionado->max_date) !!};

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




var today = new Date();

// Adicione 1 mês à data de hoje
var nextMonth = new Date(today);
nextMonth.setMonth(nextMonth.getMonth() + 1);


          var plugins = [];


          flatpickr(datepickerRef, {
              enableTime: true,
              dateFormat: 'd-m-Y H:i',
              inline: true,
              defaultDate: @json($date),
              maxDate: maxDate,


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


        /*     if (!addDays.includes(dateStr.split(' ')[0])) {
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
            } */



        }







          });
      }
  }));


</script>
@endscript
