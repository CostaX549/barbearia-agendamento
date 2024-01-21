

<div>

    
    <ul
      class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0"
      role="tablist"
      id="myTab"
      data-te-nav-ref>
      <li role="presentation" class="flex-auto text-center"
           wire:ignore.self
      >
        <a
          wire:ignore.self
          href="#tabs-home01"
          class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
          data-te-toggle="pill"
          data-te-target="#tabs-home01"
          data-te-nav-active
          role="tab"
          aria-controls="tabs-home01"
          aria-selected="true"
          >Minha Agenda</a
        >
      </li>
 
      
    </ul>
    
  
    <div class="mb-6">
      <div
        class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="tabs-home01"
        role="tabpanel"
        aria-labelledby="tabs-home-tab01"
        data-te-tab-active
        wire:ignore.self
        >
       
        <div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">
          
          <x-modal.card title="Editar Agendamento" blur wire:model="agendamentoModal" x-on:agendamento-editado.window="close" x-on:close="$wire.limpar()">
            @if($selectedAgendamento)
            <div class="flex flex-col gap-4">
           
              @foreach($selectedAgendamento->barbeiro->cortes as $corte)
              <x-checkbox
              md
          
              id="right-label"
            label="{{ $corte->nome }} - R${{ $corte->preco }}"
              wire:model="cortes.{{ $selectedAgendamento->id }}"
              class="mb-3"
             value="{{ $corte->id }}"
              autocomplete="off"
              />
           
              @endforeach
            
          
              <div x-data="bob" x-init="initDatePicker($refs.datepicker2, '{{ $selectedAgendamento->id }}', {{ json_encode($selectedAgendamento->barbeiro->workingHours()->pluck('day_of_week')->toArray()) }}, '{{ $this->date}}' )" >
                <div class="mb-4">
                    <x-input type="text" x-ref="datepicker2" wire:model="date" label="Data" placeholder="Selecione uma data"  />
                </div>
            </div>
          </div>
            
            @script
            <script>
                Alpine.data('bob', () => ({
                    date: '',
                    
            
                    initDatePicker(datepickerRef, agendamentoId, dias, start_date) {

                      
                        var diasDaSemanaMapping = {
                            'domingo': 0,
                            'segunda': 1,
                            'terça': 2,
                            'quarta': 3,
                            'quinta': 4,
                            'sexta': 5,
                            'sábado': 6
                        };
            
                        var enableDays = dias.map(function(nomeDia) {
                            return diasDaSemanaMapping[nomeDia.toLowerCase()];
                        });
                        
          
            
                        var workingHours = {!! json_encode(
                            $selectedAgendamento->barbeiro->workingHours()->get()->map(function($workingHour) {
                                return [
                                    'day' => $workingHour->dia_numero,
                                    'minTime' => $workingHour->start_hour,
                                    'maxTime' => $workingHour->end_hour,
                                ];
                            })
                        ) !!};
            
                        flatpickr(datepickerRef, {
                            enableTime: true,
                            dateFormat: 'd/m/Y H:i',
                            inline: true,
                            locale: 'pt',
                        
                            defaultDate: start_date,
                            minDate: 'today',
                            enable: [function (date) {
                                return enableDays.includes(date.getDay());
                            }],
                            onChange: function (selectedDates, dateStr, instance) {
                                var selectedDate = selectedDates[0];
                                var dayOfWeek = selectedDate.getDay();
            
                                var selectedWorkingHours = workingHours.find(function (hour) {
                                    return hour.day === dayOfWeek;
                                });
            
                                if (selectedWorkingHours) {
                                    instance.set('minTime', selectedWorkingHours.minTime);
                                    instance.set('maxTime', selectedWorkingHours.maxTime);
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
          
             
               
                  <x-slot name="footer">
                      <div class="flex justify-between gap-x-4">
                          <x-button flat negative label="Deletar" wire:click="delete({{ $selectedAgendamento->id }})" />
               
                          <div class="flex">
                              <x-button flat label="Cancelar" x-on:click="close" />
                              <x-button primary label="Editar"  spinner="editar({{ $selectedAgendamento->id }})" x-on:click="$wire.editar({{ $selectedAgendamento->id }})"  />
                          </div>
                      </div>
                  </x-slot>
                  @endif
              </x-modal.card>
        
        
      @foreach(auth()->user()->eventos as $agendamento )
      
 
   
      <div
      class="mx-auto mb-8 sm:mb-0  block rounded-lg max-w-[450px] bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]" >
      <div
        class="  relative   overflow-hidden bg-cover bg-no-repeat"
        data-te-ripple-init
        data-te-ripple-color="light">
        <img
          class="rounded-t-lg  object-cover "
          src="{{ asset("storage/" . $agendamento->barbeiro->barbearia->imagem )}}"
         style="width: 450px; height: 317px;"
          alt="" />
        <a href="/"
          wire:navigate
          >
          <div
            class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
        </a>
      </div>
      <div class="p-6">
        <h5 class="mb-2 text-xl font-medium leading-tight text-neutral-800">
          {{ \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y H:i') }}
      </h5>
        <p class="mb-2 text-base text-neutral-600">
          @php
          // Definir o idioma do Carbon para português
          \Carbon\Carbon::setLocale('pt');
      @endphp
      
      Duração: {{ Carbon\Carbon::parse($agendamento->start_date)->diffForHumans(Carbon\Carbon::parse($agendamento->end_date), true) }}
       
        
        </p>
        <p class="mb-2 text-base text-neutral-600">
         
          Cortes: @foreach($agendamento->cortes as $corte)    {{ $corte->nome }}        @endforeach
         </p>
         <p class="mb-2 text-base text-neutral-600">
         
          Cidade:   {{ $agendamento->barbeiro->barbearia->name }}
         </p>
      
         <p class="mb-4 text-base text-neutral-600">
         
          Estado:   {{ $agendamento->barbeiro->barbearia->estado }}
         </p>



         <x-button   class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]" black label="Editar" spinner="edit({{ $agendamento->id }})" 
        spinner="abrirModal({{ $agendamento->id }})" wire:click="abrirModal({{ $agendamento->id }})" />
        
    
      </div>
      </div>
 
      @endforeach
  
        </div>
    
    
        
      </div>
   
 
    </div>

   