

<div>

  @use (Carbon\Carbon)
 
  <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 


<!-- Container for demo purpose -->

 

  <!-- Navbar -->
  <nav
    class="sticky top-0 z-10 flex w-full items-center justify-between bg-white py-2 text-neutral-600 shadow-lg hover:text-neutral-700 focus:text-neutral-700 dark:bg-neutral-600 dark:text-neutral-200 md:flex-wrap md:justify-start"
    data-te-navbar-ref>
    <div class="px-6">
      <!-- Hamburger menu button -->
      <button
        class="border-0 bg-transparent px-2 py-3 text-xl leading-none transition-shadow duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white md:hidden"
        type="button"
        data-te-collapse-init
        data-te-target="#navbarSupportedContentE"
        aria-controls="navbarSupportedContentE"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <!-- Hamburger menu icon -->
        <span class="[&>svg]:w-5">
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
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </span>
      </button>

      <!-- Navigation links -->
      <div
        class="!visible hidden grow basis-[100%] items-center md:!flex md:basis-auto"
        id="navbarSupportedContentE"
        data-te-collapse-item>
        <ul
          class="mr-auto flex flex-col md:flex-row"
          data-te-navbar-nav-ref>
          <li data-te-nav-item-ref>
            <a
              class="block transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white md:p-2 [&.active]:border-primary [&.active]:text-primary"
              href="#!"
              data-te-nav-link-ref
              data-te-ripple-init
              data-te-ripple-color="light"
              >Home</a
            >
          </li>
          <li data-te-nav-item-ref>
            <a
              class="block transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white md:p-2 [&.active]:border-primary [&.active]:text-primary"
              href="#!"
              data-te-nav-link-ref
              data-te-ripple-init
              data-te-ripple-color="light"
              >Features</a
            >
          </li>
          <li data-te-nav-item-ref>
            <a
              class="block transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white md:p-2 [&.active]:border-primary [&.active]:text-primary"
              href="#!"
              data-te-nav-link-ref
              data-te-ripple-init
              data-te-ripple-color="light"
              >Pricing</a
            >
          </li>
          <li data-te-nav-item-ref>
            <a
              class="block transition duration-150 ease-in-out hover:text-neutral-700 focus:text-neutral-700 dark:hover:text-white dark:focus:text-white md:p-2 [&.active]:border-primary [&.active]:text-primary "
              href="#!"
              data-te-nav-link-ref
              data-te-ripple-init
              data-te-ripple-color="light"
              >About</a
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero section with background image, heading, subheading and button -->
  <div
    class="relative overflow-hidden bg-cover bg-center bg-no-repeat p-12 text-center"
    style="
      background-image: url('/fundopreto.jpg');
      height: 800px;
    ">
    <div
      class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-fixed"
      style="background-color: rgba(0, 0, 0, 0.6)">
      <div class="flex h-full items-center justify-center">
        <div class="text-white">
          <h2 class="mb-4 text-4xl font-semibold">{{ $barbearia->nome }}</h2>
          <h4 class="mb-6 text-xl font-semibold">{{ $barbearia->cidade }}, {{ $barbearia->estado }}</h4>
          <button
            type="button"
            data-te-toggle="modal"
            data-te-target="#exampleModalLg"
            class="rounded border-2 border-neutral-50 px-7 pb-[8px] pt-[10px] text-sm font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
            data-te-ripple-init
            data-te-ripple-color="light">
       AGENDAR AGORA
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Container for demo purpose -->
<div class="container my-16 mx-auto md:px-6">

  
  <h3 class="text-4xl text-center font-bold mb-4">Galeria</h3>
  <hr class="h-[2px] bg-gray-100  my-10 border-none" />
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
  class="grid gap-6 lg:grid-cols-3 mx-auto"
  wire:ignore.self
>


  @foreach($barbearia->galeria ?? [] as $galeria)

    <div
    class="zoom relative overflow-hidden rounded-lg bg-cover bg-no-repeat shadow-lg dark:shadow-black/20 bg-[50%]"
    data-te-ripple-init data-te-ripple-color="dark" >
    <img   src="{{ asset('storage/' . $galeria['foto']) }}"
    data-te-img="{{ asset('storage/' . $galeria['foto']) }}"
      class="w-[400px] object-cover align-middle transition duration-300 ease-linear" />
  {{--   <a   data-te-img="{{ asset('storage/' . $galeria['foto']) }}">
      <div
        class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed bg-[hsla(0,0%,0%,0.3)]">
        <div class="flex h-full items-end justify-start">
          <h5 class="m-6 text-lg font-bold text-white">
          {{ $galeria['descricao']}}
          </h5>
        </div>
      </div>
      <div>
        <div
    
          class="mask absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100 bg-[hsla(0,0%,99.2%,0.15)]">
        
        
        </div>
      </div>
    </a> --}}
  </div>

  @endforeach
</div>

</div>
  </div>
  <!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6">
  <!-- Section: Design Block -->
  <section class="mb-32 text-center md:text-left">
    <div
      class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
      <div class="flex flex-wrap items-center">
        <div class="block w-full shrink-0 grow-0 basis-auto lg:flex lg:w-6/12 xl:w-4/12">
          <img src="{{ asset('storage/' . $barbearia->imagem)}}" alt="Trendy Pants and Shoes"
            class="w-full rounded-t-lg lg:rounded-tr-none lg:rounded-bl-lg" />
        </div>
        <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 xl:w-8/12">
          <div class="px-6 py-12 md:px-12">
            <h2 class="mb-6 pb-2 text-3xl font-bold">
            Os melhores serviços
            </h2>
            <p class="mb-6 pb-2 text-neutral-500 dark:text-neutral-300">
             Corte com os melhores barbeiros  e com os melhores serviços.
            </p>
            <div class="mb-6 flex flex-wrap">
              @foreach($barbearia->barbeiros as $barbeiro)
              @foreach($barbeiro->cortes as $corte)
              <div class="mb-4 w-full md:w-4/12">
                <p class="flex">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="mr-3 h-5 w-5 text-neutral-900 dark:text-neutral-50">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>{{ $corte->nome }}
                </p>
              </div>
             @endforeach
             @endforeach
            </div>
            <button type="button"
            data-te-toggle="modal"
            data-te-target="#exampleModalLg"
              class="inline-block rounded bg-neutral-800 px-12 pt-3.5 pb-3 text-sm font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-50 dark:text-neutral-800 dark:shadow-[0_4px_9px_-4px_rgba(251,251,251,0.3)] dark:hover:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)] dark:focus:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)] dark:active:shadow-[0_8px_9px_-4px_rgba(251,251,251,0.1),0_4px_18px_0_rgba(251,251,251,0.05)]"
              data-te-ripple-init data-te-ripple-color="light">
              Agendar Agora
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
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
<!-- Button trigger modal -->

@endcan


<livewire:agendar-barbearia :barbearia="$barbearia" />


{{--   <form wire:submit="AgendarHorario"  >
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
</form> --}}




</div>

  <div class="container my-24 mx-auto md:px-6">
    <!-- Section: Design Block -->
    <section class="mb-32 text-center">
        <h2 class="mb-12 text-3xl font-bold">
            Encontre os <u class="text-black">barbeiros</u>
        </h2>

        <div class="grid gap-x-6 md:grid-cols-3 lg:gap-x-12">
            @foreach($barbearia->barbeiros as $barbeiro)
            <div class="mb-6 lg:mb-0">
                <div class="block rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
                    <div class="relative overflow-hidden bg-cover bg-no-repeat">
                        <img src="{{ asset('storage/' . $barbeiro->avatar)}}" class="w-full rounded-t-lg max-h-[400px] object-cover" />
                        <a href="#!">
                            <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed"></div>
                        </a>
                        <svg class="absolute text-white left-0 bottom-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                            <path fill="currentColor" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h5 class="mb-4 text-lg font-bold">{{ $barbeiro->name }}</h5>
                        <p class="mb-4 text-neutral-500">{{ $barbeiro->barbearia->nome }}</p>
                        <ul class="mx-auto flex list-inside justify-center">
                            <a href="#!" class="px-2">
                                <!-- GitHub -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 text-primary">
                                    <path fill="currentColor" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                            </a>
                            <a href="#!" class="px-2">
                                <!-- Twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 text-primary">
                                    <path fill="currentColor" d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#!" class="px-2">
                                <!-- Linkedin -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-3.5 w-3.5 text-primary">
                                    <path fill="currentColor" d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
                                </svg>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- Section: Design Block -->
</div>



<livewire:comentarios :barbearia="$barbearia" />



<footer
  class="flex flex-col items-center bg-neutral-900 text-center text-white">
  <div class="container px-6 pt-6">
    <!-- Social media icons container -->
    <div class="mb-6 flex justify-center">
      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
        </svg>
      </a>

      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
        </svg>
      </a>

      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M7 11v2.4h3.97c-.16 1.029-1.2 3.02-3.97 3.02-2.39 0-4.34-1.979-4.34-4.42 0-2.44 1.95-4.42 4.34-4.42 1.36 0 2.27.58 2.79 1.08l1.9-1.83c-1.22-1.14-2.8-1.83-4.69-1.83-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.721-2.84 6.721-6.84 0-.46-.051-.81-.111-1.16h-6.61zm0 0 17 2h-3v3h-2v-3h-3v-2h3v-3h2v3h3v2z"
            fill-rule="evenodd"
            clip-rule="evenodd" />
        </svg>
      </a>

      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
        </svg>
      </a>

      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z" />
        </svg>
      </a>

      <a
        href="#!"
        type="button"
        class="m-1 h-9 w-9 rounded-full border-2 border-white uppercase leading-normal text-white transition duration-150 ease-in-out hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0"
        data-te-ripple-init
        data-te-ripple-color="light">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="mx-auto h-full w-4"
          fill="currentColor"
          viewBox="0 0 24 24">
          <path
            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
        </svg>
      </a>
    </div>

    <!-- Newsletter sign-up form -->
    <div>
      <form action="">
        <div
          class="gird-cols-1 grid items-center justify-center gap-4 md:grid-cols-3">
          <div class="md:mb-6 md:ml-auto">
            <p class="">
              <strong>Sign up for our newsletter</strong>
            </p>
          </div>

          <!-- Newsletter sign-up input field -->
          <div class="relative md:mb-6" data-te-input-wrapper-init>
            <input
              type="text"
              class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] text-neutral-200 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
              id="exampleFormControlInput1"
              placeholder="Email address" />
            <label
              for="exampleFormControlInput1"
              class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-200 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-neutral-200 peer-data-[te-input-state-active]:-translate-y-[0.9rem] peer-data-[te-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-neutral-200"
              >Email address
            </label>
          </div>

          <!-- Newsletter sign-up submit button -->
          <div class="mb-6 md:mr-auto">
            <button
              type="submit"
              class="inline-block rounded border-2 border-neutral-50 px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-neutral-50 transition duration-150 ease-in-out hover:border-neutral-100 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-neutral-100 focus:border-neutral-100 focus:text-neutral-100 focus:outline-none focus:ring-0 active:border-neutral-200 active:text-neutral-200 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
              data-te-ripple-init
              data-te-ripple-color="light">
              Subscribe
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Copyright information -->
    <div class="mb-6">
      <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
        distinctio earum repellat quaerat voluptatibus placeat nam,
        commodi optio pariatur est quia magnam eum harum corrupti dicta,
        aliquam sequi voluptate quas.
      </p>
    </div>

    <!-- Links section -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4">
      <div class="mb-6">
        <h5 class="mb-2.5 font-bold uppercase">Links</h5>

        <ul class="mb-0 list-none">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>

      <div class="mb-6">
        <h5 class="mb-2.5 font-bold uppercase">Links</h5>

        <ul class="mb-0 list-none">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>

      <div class="mb-6">
        <h5 class="mb-2.5 font-bold uppercase">Links</h5>

        <ul class="mb-0 list-none">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>

      <div class="mb-6">
        <h5 class="mb-2.5 font-bold uppercase">Links</h5>

        <ul class="mb-0 list-none">
          <li>
            <a href="#!" class="text-white">Link 1</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 2</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 3</a>
          </li>
          <li>
            <a href="#!" class="text-white">Link 4</a>
          </li>
        </ul>
      </div>
    </div>


  <!-- Copyright section -->
  <div
    class="w-full p-4 text-center"
    style="background-color: rgba(0, 0, 0, 0.2)">
    © 2023 Copyright:
    <a class="text-white" href="https://tw-elements.com/">TW elements</a>
  </div>
</footer>


</div>
