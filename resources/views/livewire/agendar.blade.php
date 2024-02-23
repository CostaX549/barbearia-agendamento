<div class="flex  items-center justify-center">
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 

<div class="absolute top-1 left-38   flex gap-2">
  @foreach(['Em breve', 'Em atraso', 'Concluída'] as $filterOption)
      <div>
          <input type="radio" wire:model.change="option" id="{{ $filterOption }}" value="{{ $filterOption }}" class="peer hidden " />
          <label for="{{ $filterOption }}" class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white">
              {{ ucfirst($filterOption) }}
          </label>
      </div>
  @endforeach

</div>
{{-- <ol  class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-4 gap-6 ml-56  mt-16  max-md:m-auto ">
    <div
    class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
    role="status" wire:loading wire:target="option">
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Loading...</span
    >
  </div>

  @foreach($this->agendamentos as $agendamento)

  

<div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl w-96">
  <div class="p-6">
 

    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"   class="w-12 h-12 mb-4 text-gray-900">
      <path stroke-linecap="round" stroke-linejoin="round" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
    </svg>
    
    <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
     {{ $agendamento->barbeiro->name }}
    </h5>
    <p class="block font-sans text-base antialiased font-semibold leading-relaxed text-inherit">
      Cortes: @foreach($agendamento->cortes as $corte)  {{ $corte->nome }}      @endforeach
    </p>
    
    <p class="block font-sans text-base antialiased font-semibold leading-relaxed text-inherit">
      @php
      $diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
      $diaSemana = $diasDaSemana[date('w', strtotime($agendamento->start_date))];
      @endphp
      
      Dia: {{ \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y H:i') }} - {{ $diaSemana }}
    </p>
   
  </div>
  <div class="p-6 pl-2 pt-0">
    <a href="#" class="inline-block">
      <button
      wire:click ="EventoConcluido({{$agendamento->id}})"
        class="flex items-center gap-2 px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
        type="button">
       Concluir
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
          stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
        </svg>
      </button>
    </a>
  </div>
</div> 
@endforeach 


</ol> --}}

<section class="bg-white dark:bg-gray-900 antialiased">
  <div class="max-w-screen-xl px-4 py-8 mx-auto lg:px-6 sm:py-16 lg:py-24">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="text-4xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white">
     Agendamentos
      </h2>

      <div class="mt-4">
        <a href="#" title=""
          class="inline-flex items-center text-lg font-medium text-primary-600 hover:underline dark:text-primary-500">
          Learn more about our agenda
          <svg aria-hidden="true" class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
        </a>
      </div>
    </div>


@foreach($this->agendamentos as $agendamento)
@if($loop->first)
<div class="flow-root max-w-3xl mx-auto mt-8 sm:mt-12 lg:mt-16">
  <div class="-my-4 divide-y divide-gray-200 dark:divide-gray-700">
    <div class="flex flex-col gap-2 py-4 sm:gap-6 sm:flex-row sm:items-center">
      <p class="w-32 text-lg font-normal text-gray-500 sm:text-right dark:text-gray-400 shrink-0">
       {{ \Carbon\Carbon::parse($agendamento->start_date)->format('H:i') }} -    {{ \Carbon\Carbon::parse($agendamento->end_date)->format('H:i') }} 
      </p>
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        <a href="#" class="flex items-center hover:underline">{{     \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y')  }} - {{ $agendamento->barbeiro->name }} - Cortes: @foreach($agendamento->cortes as $corte) {{ $corte->nome }} @endforeach - <img src="{{ $agendamento->user->profile_photo_url }}" class="rounded-full ml-2 h-11"> </a>
      </h3>
    </div>
@else
        <div class="flex flex-col gap-2 py-4 sm:gap-6 sm:flex-row sm:items-center">
          <p class="w-32 text-lg font-normal text-gray-500 sm:text-right dark:text-gray-400 shrink-0">
            {{ \Carbon\Carbon::parse($agendamento->start_date)->format('H:i') }} -    {{ \Carbon\Carbon::parse($agendamento->end_date)->format('H:i') }} 
          </p>
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            <a href="#" class="flex items-center hover:underline">{{     \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y')  }} - {{ $agendamento->barbeiro->name }} - Cortes: @foreach($agendamento->cortes as $corte) {{ $corte->nome }} @endforeach - <img src="{{ $agendamento->user->profile_photo_url }}" class="rounded-full ml-2 h-11"> </a>
          </h3>
        </div>
@endif

     @endforeach   
      </div>
    </div>
  </div>
</section>

</div>
