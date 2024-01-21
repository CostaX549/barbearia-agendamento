

<div>

  @use (Carbon\Carbon)
 
  

 
  <!-- Container for demo purpose -->
<div class="container my-16 mx-auto md:px-6">

    <section class="mb-12">
      <!-- Jumbotron -->
      <div class="container mx-auto text-center lg:text-left xl:px-32">
        <div class="flex grid items-center lg:grid-cols-2 ">
          <div class="mb-12 lg:mb-0">
            <div
              class="block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] md:px-12 lg:-mr-14 backdrop-blur-[30px]">
              <h3 class="mb-3 text-2xl font-bold">
              {{ $barbearia->nome }}
              </h3>
              <h5 class="mb-12 text-lg font-bold text-primary lg:mb-10 xl:mb-12">
                Let us answer your questions
              </h5>
  
              <p class="mb-4 font-bold">
                Anim pariatur cliche reprehenderit?
              </p>
              <p class="mb-6 text-gray-500">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt
                autem numquam dolore molestias aperiam culpa alias veritatis
                architecto eos, molestiae vitae ex eligendi libero eveniet
                dolorem, doloremque rem aliquid perferendis.
              </p>
  
              <p class="mb-4 font-bold">
                Non cupidatat skateboard dolor brunch?
              </p>
              <p class="mb-6 text-gray-500">
                Distinctio corporis, iure facere ducimus quos consectetur ipsa
                ut magnam autem doloremque ex! Id, sequi. Voluptatum magnam
                sed fugit iusto minus et suscipit? Minima sunt at nulla
                tenetur, numquam unde quod modi magnam ab deserunt ipsam sint
                aliquid dolores libero repellendus cupiditate mollitia quidem
                dolorem odit
              </p>
  
              <p class="mb-4 font-bold">
                Praesentium voluptatibus temporibus consequatur non
                aspernatur?
              </p>
              <p class="text-gray-500">
                Minima sunt at nulla tenetur, numquam unde quod modi magnam ab
                deserunt ipsam sint aliquid dolores libero repellendus
                cupiditate mollitia quidem dolorem.
              </p>
            </div>
          </div>
  
          <div>
            <img  src="{{ asset('storage/' . $barbearia->imagem) }}"
              class="w-full rounded-lg shadow-lg" alt="" />
          </div>
        </div>
      </div>
      <!-- Jumbotron -->
     
    </section>

<h2 class="mb-5 mt-0 text-4xl text-center  font-medium leading-tight text-black">
Galeria
</h2>
<div
data-te-lightbox-init
class="flex flex-col space-y-5 lg:flex-row lg:space-x-5 lg:space-y-0">
{{-- <div class="h-full w-full">
  <img
    src="/barbearia.avif"
    data-te-img="/barbearia.avif"
    alt="Table Full of Spices"
    class="w-full cursor-zoom-in rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto" />
</div>
<div class="h-full w-full">
  <img
    src="/barbearia.avif"
    data-te-img="/barbearia.avif"
    alt="Winter Landscape"
    class="w-full cursor-zoom-in rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto" />
</div>
<div class="h-full w-full">
  <img
  src="/barbearia.avif"
    data-te-img="/barbearia.avif"
    alt="View of the City in the Mountains"
    class="w-full cursor-zoom-in rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto" />
</div> --}}
@can('create',$barbearia)

<div class="mx-auto cursor-pointer" x-on:click="$openModal('galeriaModal')">
  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" version="1.1" id="Capa_1" width="100px" height="100px" viewBox="0 0 45.402 45.402" xml:space="preserve">
    <g>
      <path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"/>
    </g>
    </svg>
</div>
<x-modal.card title="Adicionar items" blur wire:model.defer="galeriaModal">
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


      <div class="col-span-1 sm:col-span-2">
       
      </div>

      <div class="col-span-1 sm:col-span-2 cursor-pointer bg-gray-100 rounded-xl shadow-md h-72 flex items-center justify-center">
       
            <label for="fotos" class="flex flex-col items-center justify-center cursor-pointer">
              <x-icon name="cloud-upload" class="w-16 h-16 text-blue-600" />
              <p class="text-blue-600">Click or drop files here</p>
            </label>
        
      </div>
  </div>
  <input type="file" id="fotos" multiple wire:model="fotos"  class="sr-only">

@forelse($fotos as $foto)
<div class="mb-4 mt-3">
  <img src="{{ $foto->temporaryUrl() }}"  class="max-w-full h-auto rounded-lg">
  <x-input wire:model="descricao.{{ $loop->index }}" label="Descrição" placeholder="Descrição" class="mt-3 " />
</div>

@empty


@endforelse
  <x-slot name="footer">
      <div class="flex justify-between gap-x-4">
          <x-button flat negative label="Delete" wire:click="delete" />

          <div class="flex">
              <x-button flat label="Cancel" x-on:click="close" />
              <x-button primary label="Save" wire:click="salvarGaleria" />
          </div>
      </div>
  </x-slot>
</x-modal.card>
@endcan
<div
  data-te-lightbox-init
  class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5"
  wire:ignore.self
>
  @foreach($barbearia->galeria ?? [] as $galeria)
    <div class="h-full w-full" wire:key="galeria-{{ $galeria['descricao'] }}">
      <img
        src="{{ asset('storage/' . $galeria['foto']) }}"
        data-te-img="{{ asset('storage/' . $galeria['foto']) }}"
        alt="{{ $galeria['descricao'] }}"
        class="w-full cursor-zoom-in rounded shadow-sm data-[te-lightbox-disabled]:cursor-auto"
      />

    
    </div>
  @endforeach
</div>

</div>
  </div>
  
  <div class="flex justify-center">
    @can('create',$barbearia)
    <a
    type="button"
   href="/gerenciar/{{$barbearia->slug}}"
    class=" w-[300px] text-center inline-block rounded bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
         Gerenciar Barbearia
  </a>
  @else
  <button
  type="button"
  x-on:click="$openModal('agendarModal')"
  class=" w-[300px] inline-block rounded bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
       Agendar Agora
</button>
@endcan

<x-modal.card title="Agendar" blur wire:model="agendarModal" x-on:agendamento-salvo.window="close" style="display: none;">
  <form wire:submit="AgendarHorario"  >
  <x-select
  label="Selecionar Barbeiro"
  placeholder="Selecionar Barbeiro"
  wire:model.blur="barbeiroModel"
  class="mb-3"
  autocomplete="off"
>

@foreach($this->barbeiros as $barbeiro)

  <x-select.user-option src="/barbearia.avif" label="{{ $barbeiro->name }}" value="{{ $barbeiro->id }}" />

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
<x-select.user-option src="/barbearia.avif" label="{{ $corte->nome }} - R${{ $corte->preco }}" value="{{ $corte->id }}" />

@endforeach
</x-select>
<div x-data="bob" x-init="initDatePicker($refs.datepicker2)" wire:ignore>
  <div class="mb-4">
      <x-input type="text"  x-ref="datepicker2" wire:model.live="date" label="Data" placeholder="Selecione uma data" />
  </div>
</div>
@script
<script>
  Alpine.data('bob', () => ({
      date: '',
      
      initDatePicker(datepickerRef) {
          var enableDays = {!! json_encode($this->barbeiroSelecionado->workingHours->pluck('dia_numero')->toArray()) !!};
     
          var workingHours = {!! json_encode(
              $this->barbeiroSelecionado->workingHours->map(function($workingHour) {
                  return [
                      'day' => $workingHour->dia_numero,
                      'minTime' => $workingHour->start_hour,
                      'maxTime' => $workingHour->end_hour,
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

<div class="ml-2" wire:loading wire:target="date">
  <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
      <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
  </div>
</div>

@if($date)
<h1 class="mb-3">Horários Disponíveis:</h1>

<div wire:loading.remove wire:target="date">
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
</div>
<x-select
label="Modo de Pagamento"
placeholder="Selecione um método de pagamento"
:options="['Pagar Agora', 'Pagar no Salão']"
class="mt-4"
autocomplete="off"
wire:model.blur="payment"
/>
@endif
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

  <x-slot name="footer">
      <div class="flex justify-between gap-x-4">
      

          <div class="flex">
              <x-button flat label="Cancelar" x-on:click="close" />
              <x-button primary  spinner="AgendarHorario" wire:click="AgendarHorario" label="Agendar"   />
          </div>
      </div>
  </x-slot>
</form>

</x-modal.card>

</div>
  <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32 text-center">
      <h2 class="mb-12 text-3xl font-bold">
      Encontre os <u class="text-black">barbeiros</u>
      </h2>
  
      <div class="grid gap-x-6 md:grid-cols-3 lg:gap-x-12">
        <div class="mb-6 lg:mb-0">
          <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div class="relative overflow-hidden bg-cover bg-no-repeat">
              <img src="/barbearia.avif" class="w-full rounded-t-lg" />
              <a href="#!">
                <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed"></div>
              </a>
              <svg class="absolute text-white left-0 bottom-0" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320">
                <path fill="currentColor"
                  d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Maria Smith</h5>
              <p class="mb-4 text-neutral-500">Frontend Developer</p>
              <ul class="mx-auto flex list-inside justify-center">
                <a href="#!" class="px-2">
                  <!-- GitHub -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-4 w-4 text-primary">
                    <path fill="currentColor"
                      d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Twitter -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-4 w-4 text-primary">
                    <path fill="currentColor"
                      d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Linkedin -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-3.5 w-3.5 text-primary">
                    <path fill="currentColor"
                      d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                  </svg>
                </a>
              </ul>
            </div>
          </div>
        </div>
  
        <div class="mb-6 lg:mb-0">
          <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div class="relative overflow-hidden bg-cover bg-no-repeat">
              <img src="/barbearia.avif" class="w-full rounded-t-lg" />
              <a href="#!">
                <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed"></div>
              </a>
              <svg class="absolute text-white  left-0 bottom-0" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320">
                <path fill="currentColor"
                  d="M0,96L48,128C96,160,192,224,288,240C384,256,480,224,576,213.3C672,203,768,213,864,202.7C960,192,1056,160,1152,128C1248,96,1344,64,1392,48L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Darren Randolph</h5>
              <p class="mb-4 text-neutral-500">Marketing expert</p>
              <ul class="mx-auto flex list-inside justify-center">
                <a href="#!" class="px-2">
                  <!-- Facebook -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary"
                    fill="currentColor" viewBox="0 0 24 24">
                    <path
                      d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Twitter -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-4 w-4 text-primary">
                    <path fill="currentColor"
                      d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Linkedin -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-3.5 w-3.5 text-primary">
                    <path fill="currentColor"
                      d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                  </svg>
                </a>
              </ul>
            </div>
          </div>
        </div>
  
        <div class="">
          <div
            class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
            <div class="relative overflow-hidden bg-cover bg-no-repeat">
              <img src="/barbearia.avif" class="w-full rounded-t-lg" />
              <a href="#!">
                <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed"></div>
              </a>
              <svg class="absolute text-white left-0 bottom-0" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1440 320">
                <path fill="currentColor"
                  d="M0,288L48,256C96,224,192,160,288,160C384,160,480,224,576,213.3C672,203,768,117,864,85.3C960,53,1056,75,1152,69.3C1248,64,1344,32,1392,16L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
              </svg>
            </div>
            <div class="p-6">
              <h5 class="mb-4 text-lg font-bold">Ayat Black</h5>
              <p class="mb-4 text-neutral-500">Web designer</p>
              <ul class="mx-auto flex list-inside justify-center">
                <a href="#!" class="px-2">
                  <!-- Dribbble -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-4 w-4 text-primary">
                    <path fill="currentColor"
                      d="M12 0c-6.628 0-12 5.373-12 12s5.372 12 12 12 12-5.373 12-12-5.372-12-12-12zm9.885 11.441c-2.575-.422-4.943-.445-7.103-.073-.244-.563-.497-1.125-.767-1.68 2.31-1 4.165-2.358 5.548-4.082 1.35 1.594 2.197 3.619 2.322 5.835zm-3.842-7.282c-1.205 1.554-2.868 2.783-4.986 3.68-1.016-1.861-2.178-3.676-3.488-5.438.779-.197 1.591-.314 2.431-.314 2.275 0 4.368.779 6.043 2.072zm-10.516-.993c1.331 1.742 2.511 3.538 3.537 5.381-2.43.715-5.331 1.082-8.684 1.105.692-2.835 2.601-5.193 5.147-6.486zm-5.44 8.834l.013-.256c3.849-.005 7.169-.448 9.95-1.322.233.475.456.952.67 1.432-3.38 1.057-6.165 3.222-8.337 6.48-1.432-1.719-2.296-3.927-2.296-6.334zm3.829 7.81c1.969-3.088 4.482-5.098 7.598-6.027.928 2.42 1.609 4.91 2.043 7.46-3.349 1.291-6.953.666-9.641-1.433zm11.586.43c-.438-2.353-1.08-4.653-1.92-6.897 1.876-.265 3.94-.196 6.199.196-.437 2.786-2.028 5.192-4.279 6.701z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Linkedin -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-3.5 w-3.5 text-primary">
                    <path fill="currentColor"
                      d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                  </svg>
                </a>
                <a href="#!" class="px-2">
                  <!-- Instagram -->
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="h-4 w-4 text-primary">
                    <path fill="currentColor"
                      d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                  </svg>
                </a>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Design Block -->
  </div>

 
  <!-- Container for demo purpose -->
</div>
