<div>
    
 @use(Carbon\Carbon)


    
 


<!--Large modal-->
<div
  data-te-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
  id="exampleModalLg"
  tabindex="-1"
  aria-labelledby="exampleModalLgLabel"
  aria-modal="true"
  wire:ignore.self
  role="dialog">
  <div
    data-te-modal-dialog-ref
    wire:ignore.self
    class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
    <div
      class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
      <div
        class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
        <!--Modal title-->
        <h5
          class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
          id="exampleModalLgLabel">
        Agendar
        </h5>
        <!--Close button-->
        <button
          type="button"
          class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-modal-dismiss
          aria-label="Close">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <!--Modal body-->
      <div class="relative p-4"><form wire:submit="AgendarHorario">
        <x-select
        label="Selecionar Barbeiro"
        placeholder="Selecionar Barbeiro"
        wire:model.blur="barbeiroModel"
        class="mb-3"
        autocomplete="off"
      >
      
      @foreach($this->barbeiros as $barbeiro)
      
        <x-select.user-option src="{{ asset('storage/' . $barbeiro->avatar)}}" label="{{ $barbeiro->name }}" value="{{ $barbeiro->id }}" />
      
        @endforeach
      </x-select>
      
      <div class="ml-2" wire:loading wire:target="barbeiroModel">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
      </div>
      @if($barbeiroModel)
      
      <x-select
      label="Selecionar Corte"
      multiselect
      placeholder="Selecionar Corte"
      wire:model.live="cortes"
      
      class="mb-3"
      autocomplete="off"
      >
      @foreach($this->barbeiroSelecionado->cortes as $corte)
      <x-select.user-option src="{{ asset('storage/' . $this->barbeiroSelecionado->avatar)}}" label="{{ $corte->nome }} - R${{ $corte->preco }}" value="{{ $corte->id }}" />
      
      @endforeach
      </x-select>
 {{--      <div x-data="bob" x-init="initDatePicker($refs.datepicker2)" wire:ignore>
        <div class="mb-4">
            <x-input type="text"  x-ref="datepicker2" wire:model.live="date" label="Data" placeholder="Selecione uma data" />
        </div>
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
                
      
                flatpickr(datepickerRef, {
                    enableTime: true,
                    dateFormat: 'd-m-Y H:i',
                    inline: true,
                    plugins: [
                    new minMaxTimePlugin({
                        table:  formattedDatesJson
                    })
                ],

                
              
                    locale: 'pt',
                    defaultHour: 13,
                    minDate: 'today',

                    disable: [
        {
            from: "06-02-2024 08:00",
            to: "06-02-2024 10:00"
        },
      
    ],
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
      
      <div class="ml-2" wire:loading wire:target="date">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
      </div>
      
      @if($date)
      <h1 class="mb-3">Horários Disponíveis:</h1>
      
      <div wire:loading.remove wire:target="date">

 


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
        @endphp
    
        @php
            $dateTime = $startDateAdd->format('Y-m-d H:i');
            $isAgendado = in_array($dateTime, $horariosAgendados);
        @endphp
    
        @if($isAgendado)
            <x-badge label="{{ $hour }}" negative />
        @else
            <x-badge label="{{ $hour }}" />
        @endif
    
        @php
            $startDateAdd->addHour();
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
                $interval = new DateInterval('PT1H'); // Intervalo de 1 hora
                $currentHour = $startHour;
            @endphp
      
            @while($currentHour < $endHour)
                @php
                    $formattedHour = $currentHour->format('H:i');
                    $currentDateTime = Carbon::parse($this->date)->setTime($currentHour->format('H'), $currentHour->format('i'));
                   
                    $isAgendado = in_array($currentDateTime->format('Y-m-d H:i'), $horariosAgendados);
                @endphp
      
                @if($isAgendado)
                  
                    <x-badge label="{{ $formattedHour }}" negative />
                @else
                  
                    <x-badge label="{{ $formattedHour }}" />
                @endif
      
                @php
                    $currentHour->add($interval);
                @endphp
            @endwhile
        @endif
      @endforeach

 

      </div> --}}

      
      <livewire:date-picker  wire:model="date" :formattedDates="$formattedDates" :barbeiroSelecionado="$barbeiroSelecionado" />
  

<x-select
label="Modo de Pagamento"
placeholder="Selecione um método de pagamento"
:options="['Pagar Agora', 'Pagar no Salão']"
class="mt-4"
autocomplete="off"
wire:model.blur="payment"
/>
      <div class="ml-2" wire:loading wire:target="payment">
        <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
            <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
        </div>
      </div>
      @if($payment === 'Pagar Agora' && $this->cortes)
      
      @php 
        $this->total = 0;
              foreach($this->cortes as $valor) {
                  $corte = \App\Models\Cortes::findOrFail($valor);
                  $this->total += $corte->preco;
              }
              
      @endphp
      
      <div class="mt-3" x-data="paypalIntegration" x-init="initPaypal($refs.button)" x-ref="button" wire:ignore >
          
          </div>
      
          @script 
      <script>
        Alpine.data('paypalIntegration', () => ({
          initPaypal(button) {
         
      
           
                  paypal.Buttons({
                      createOrder: function (data, actions) {
                          return actions.order.create({
                              purchase_units: [
                                  {
                                      amount: {
                                          value: '{{ $this->total }}',
                                      },
                                  },
                              ],
                          });
                      },
                      onApprove: function (data, actions) {
                          return actions.order.capture().then(function (orderData) {
                              const transaction = orderData.purchase_units[0].payments.captures[0];
                              
                             
                                  Livewire.dispatch('transactionEmit', {
                                      transactionId: transaction.id,
                                  });
                             
                          });
                      },
                  }).render(button);
            
          },
      }));
      </script>
          @endscript
      @endif
      @endif

    
    </div>


      <div
      class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
      <button
        type="button"
        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
        data-te-modal-dismiss
        data-te-ripple-init
        data-te-ripple-color="light">
        Fechar
      </button>
      <button
        type="submit"
        class="ml-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
        data-te-ripple-init
        wire:target="AgendarHorario"
     wire:click="AgendarHorario"
        wire:loading.class="opacity-50"
     
      >
     
Agendar
      </button>
    </form>
    </div>
    </div>
  </div>
</div>
</div>