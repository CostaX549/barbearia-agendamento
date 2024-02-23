<div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js' defer></script>
<script src="
https://cdn.jsdelivr.net/npm/@fullcalendar/moment-timezone@6.1.10/index.global.min.js
" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/locales/pt-br.js" defer></script>

    <div wire:ignore id='calendar' class="max-w-[50%] mx-auto"></div>



<x-modal.card title="Editar Dia" blur wire:model="cardModal" x-on:open-modal.window="open">
{{--     @if($this->date)
    @php
        $carbonDate = \Carbon\Carbon::parse($this->date);
        $dayOfWeek = $carbonDate->format('N');

        $diasDaSemana = [
            '1' => 'Segunda',
            '2' => 'Terça',
            '3' => 'Quarta',
            '4' => 'Quinta',
            '5' => 'Sexta',
            '6' => 'Sábado',
            '7' => 'Domingo',
        ];

        $trabalhaNesseDia = in_array($diasDaSemana[$dayOfWeek], $barbeiro->workingHours->pluck("day_of_week")->toArray());

        $diaAdicionado = $barbeiro->specificDates()
                                ->where('status', 'adicionar')->get()->isNotEmpty();
                                
             
        $diaRemovido = $barbeiro->specificDates()
                                ->where('status', 'remover')->where('start_date',$this->date)->get()->isNotEmpty();
                              
            $diaAdicional = $barbeiro->specificDates()
                                ->where('start_date',$this->date)->get()->isEmpty();
             
            $diaIgual = $barbeiro->specificDates()
                                ->where('start_date',$this->date )->get()->isNotEmpty();
                            
                                
    @endphp

    @if(  $diaAdicional || $diaRemovido )
        <button
            type="button"
            wire:click="add"
            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
            Adicionar dia de Trabalho
        </button>
    @elseif($diaIgual  )
        <button
            type="button"
            wire:click="remover"
            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
            Remover dia de trabalho
        </button>
    @endif
@endif --}}

@if($this->date)
    @php
        $carbonDate = \Carbon\Carbon::parse($this->date);
        $carbonDateFinal = \Carbon\Carbon::parse($this->dateFinal);
        $dayOfWeek = $carbonDate->format('N');

   

 



        $diaAdicionado = $barbeiro->specificDates()
                                ->where('status', 'adicionar')
                                ->where(function ($query) use ($carbonDate, $carbonDateFinal) {
                                    $query->where('start_date', '<=', $carbonDate)
                                          ->where('end_date', '>=',  $carbonDateFinal);
                                })
                                ->exists();

                            

        // Verifica se existe uma data específica removida para esse dia
        $diaRemovido = $barbeiro->specificDates()
                                ->where('status', 'remover')
                                ->where(function ($query) use ($carbonDate, $carbonDateFinal) {
                                    $query->where('start_date', '<=', $carbonDate)
                                          ->where('end_date', '>=', $carbonDateFinal);
                                })
                                ->exists();

        // Verifica se o horário atual está dentro dos horários de trabalho específicos
        $horaAtual = $carbonDate->format('H:i:s');
        $horaFinal = \Carbon\Carbon::parse($this->dateFinal)->format('H:i:s');
    
   
        $dentroDosHorarios = $barbeiro->workingHours()
                                      ->where('day_of_week', $dayOfWeek)
                                      ->where('start_hour', '<=', $horaAtual)
                                      ->where('end_hour', '>=', $horaFinal)
                                      ->exists();

                                  
    @endphp

    @if((!$dentroDosHorarios && !$diaAdicionado) || $diaRemovido   )
        <button
            type="button"
            wire:click="add"
            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
            Adicionar dia de Trabalho
        </button>
    @elseif($dentroDosHorarios || $diaAdicionado )
        <button
            type="button"
            wire:click="remover"
            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
            Remover dia de trabalho
        </button>
    @endif
@endif
</x-modal.card>
    <script >
        document.addEventListener('livewire:navigated', function() {


     
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    
                    headerToolbar: {
left: 'prev,next today',
right: 'dayGridMonth,timeGridWeek,timeGridDay' // Adicionei a vírgula aqui
},
                
                    timeZone: 'America/Sao_Paulo',
                    editable: true,
                   
                  events: @json($agendamentos),
                    selectable: true,
                   
                    locale: 'pt-br', 
                    validRange: {
                    start: new Date(), // Impede datas anteriores à data atual
                  
                },
                    select: function(data) {
                      Livewire.dispatch('open-modal', {
                        date: data,
                      });

                        
  
                       
                    },

                 
        
     
   
             
                    eventDrop: function(data) {
                        
                        @this.updateEvent(
                            data.event.id,
                            data.event.name,
                            data.event.start.toISOString(),
                            data.event.end.toISOString()).then(function() {
                                
                            })
                    },
                    businessHours:   @json($jsonHorarios),
                      
                       
                    
             

                    
                });
                
                console.log(new Date());
                calendar.render();
                console.log(@json($agendamentos))
        });
    </script> 


</div>
