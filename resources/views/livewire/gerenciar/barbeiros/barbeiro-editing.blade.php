{{-- <div>

        @can('pagar',auth()->user())
        <div class="mt-3" x-data x-init="
        const paypalButtonContainer = $refs.paypalButtonContainer;
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            amount: {
                                value: '15',
                            },
                            


                        },
                    ],
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (orderData) {
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    if (transaction.status == 'COMPLETED') {
                     
                        Livewire.dispatch('transactionEmit', {
                            transactionId: transaction.id,
                            ,
                        }); 
                        console.log(orderData);
                    }
                });
            },
        }).render(paypalButtonContainer);
    " x-ref="paypalButtonContainer" wire:ignore>
    
    </div>
        @else
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
      <div x-data="bob" x-init="initDatePicker($refs.datepicker2)" wire:ignore>
          <div class="mb-4">
              <x-input  class=" sm:text-xl font-medium" x-ref="datepicker2" wire:model.live="date" label="Data" placeholder="Selecione uma data" />
          </div>
        </div>
   
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
       
        Cidade:   {{ $agendamento->barbeiro->barbearia->cidade }}
       </p>
    
       <p class="mb-4 text-base text-neutral-600">
       
        Estado:   {{ $agendamento->barbeiro->barbearia->estado }}
       </p>
      <button
      type="button"
      data-te-ripple-init
      data-te-ripple-color="light"
     wire:click="edit({{ $agendamento->id }})"
      class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
     EDITAR
      </button>
    </div>
    </div>


</div>


@script
<script>
  Alpine.data('bob', () => ({
      date: '',
      
      initDatePicker(datepickerRef) {
          var dias = {!! json_encode($agendamento->barbeiro->workingHours()->pluck('day_of_week')->toArray()) !!};

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
              $agendamento->barbeiro->workingHours->map(function($workingHour) {
                  return [
                      'day' => $workingHour->dia_numero,
                      'minTime' => $workingHour->start_hour,
                      'maxTime' => $workingHour->end_hour,
                  ];
              })
          ) !!};

          var bookedDates = {!! json_encode(
              $agendamento->barbeiro->agendamentos->pluck("start_date")
                  ->map(function($date) {
                      return \Carbon\Carbon::parse($date)->format('d-m-Y H:i');
                  })
                  ->toArray()
          ) !!};
          

          flatpickr(datepickerRef, {
              enableTime: true,
              dateFormat: 'd-m-Y H:i',
              inline: true,
              locale: 'pt',
            
              defaultHour: 13,
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
@endcan --}}


<div class="mb-24 md:mb-0">
  
    <form wire:submit="editarBarbeiro({{ $barbeiro->id }})">
  
    <div
      class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
  
   
      <label for="arquivo" class="cursor-pointer">
      <div class="flex justify-center relative text-blue-500">
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-12">
    
          <span class="material-symbols-outlined">
            edit
            </span>
       
        </div>
    
            <!-- Imagem com opacidade -->

            @if(!$foto)

       
                  <div class="flex justify-center -mt-[75px]">
                    <img src="{{ $barbeiro->user->profile_photo_url }}"
                        class="mx-auto rounded-full shadow-lg dark:shadow-black/20 w-[150px] h-[150px] object-cover opacity-50" alt="Avatar" />
                      </div>
  
          @else
          <div class="flex justify-center -mt-[75px]">
            <!-- Imagem com opacidade -->
            <img src="{{ $foto->temporaryUrl()}}"
                class="mx-auto rounded-full shadow-lg dark:shadow-black/20 w-[150px] h-[150px] object-cover" alt="Avatar" />
          </div>
        @endif
        <input type="file" wire:model="foto" id="arquivo" class="sr-only">
    </div>
  </label>



  <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 

      <div class="p-6">
        
        <x-input
        label="Nome"
        placeholder="Nome"
        wire:model="name"
        description="Inform your full name"
   
        class="mb-3 sm:text-xl"
    />

    <div  class="flex flex-col gap-4 mb-6">
 @foreach($barbeiro->barbearia->cortes as $corte)
 <x-checkbox md id="right-label" label="{{ $corte->nome }} - R${{ $corte->preco }}"   wire:model.blur="cortes"  value="{{ $corte->id}}" />

 @endforeach
</div>

  
        
        <ul class="">
        
          <div  class="flex flex-col gap-4">
            @foreach($this->allDaysOfWeek as $index => $day)
            <x-checkbox md id="right-label" label="{{ $day }}"   wire:model="dias.{{ $day }}"  wire:click="toggleCheckbox('{{ $day }}')"/>
            <x-time-picker
            
            wire:model.blur="horariosIniciais.{{ $day }}"
            label="Horário Inicial"
            
            placeholder="22:30"
            format="24"
            class="mb-3"
            />

         
            
            <x-time-picker
            
            wire:model.blur="horariosFinais.{{ $day }}"
            label="Horário Final"
            
            placeholder="22:30"
            format="24"
            class="mb-3"
            />
            @endforeach

            <x-select
            label="Aceitar Agendamentos Até"
            placeholder="Selecione uma opção"
            :options="['15 Dias', '1 Mês', '3 Meses', '6 Meses']"
            wire:model="option"
        />
               
            <x-time-picker
            
            wire:model="interval"
            label="Intervalo dos agendamentos"
            
            placeholder="22:30"
            format="24"
            class="mb-3"
            />

           
      
           
        
            
     
            <x-button  class="mb-3" black label="Editar" spinner="editarBarbeiro" wire:click="editarBarbeiro({{ $barbeiro->id }})" />
   
            </div>
          </form>
 
        </ul>
      </div>
    </div>
  </div>

  