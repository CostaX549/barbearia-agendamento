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
<ol  class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-4 gap-6 ml-56  mt-16  max-md:m-auto ">
    <div
    class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
    role="status" wire:loading wire:target="option">
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Loading...</span
    >
  </div>

  @foreach($this->agendamentos as $agendamento)
  {{-- <div  wire:loading.remove wire:target="option">
  <x-modal wire:model="simpleModal.{{ $agendamento->id }}">
    <x-card title="Detalhes">
        <p class="text-gray-600">
            Lorem Ipsum...
        </p>
 
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />
                <x-button primary label="I Agree" />
            </div>
        </x-slot>
    </x-card>
</x-modal>
  <li>
    <div class="flex-start md:flex">
      <div
        class="-ml-[13px] flex h-[25px] w-[25px] items-center justify-center rounded-full bg-info-100 text-info-700">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="currentColor"
          class="h-4 w-4">
          <path
            fill-rule="evenodd"
            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
            clip-rule="evenodd" />
        </svg>
      </div>
      <div
        class="mb-10 ml-6 block max-w-md rounded-lg bg-neutral-50 p-6 shadow-md shadow-black/5 dark:bg-neutral-700 dark:shadow-black/10">
        <div class="mb-4 flex items-center justify-between">
          <a
            href="#!"
            class="text-sm  text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >{{ $agendamento->user->name }}</a
          >
          @php 
\Carbon\Carbon::setLocale('pt-BR');

          @endphp


          <a
            href="#!"
            class=" gap-2 flex items-center text-sm text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >{{ \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y H:i') }} -  <x-badge md icon="clock"  label="{{ \Carbon\Carbon::parse($agendamento->start_date)->diffForHumans(\Carbon\Carbon::parse($agendamento->end_date),true) }}" /></a
          >
        </div>
        <p class="mb-6 text-neutral-700 dark:text-neutral-200">
           
            <x-badge md icon="user"  label="{{ $agendamento->barbeiro->name }}" />
        @foreach($agendamento->cortes as $corte)
        <x-badge md icon="scissors"  label="{{ $corte->nome }}" />
        @endforeach
        
        </p>
        <button
          wire:click ="EventoConcluido({{$agendamento->id}})"
          type="button"
          class="inline-block rounded bg-info px-4 pb-[5px] pt-[6px] text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#54b4d3] transition duration-150 ease-in-out hover:bg-info-600 hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:bg-info-600 focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:outline-none focus:ring-0 active:bg-info-700 active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(84,180,211,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)]"
          data-te-ripple-init
          data-te-ripple-color="light">
          Concluído
        </button>
        <button
          type="button"
          x-on:click="$wire.simpleModal[{{ $agendamento->id }}] = true"
          class="inline-block rounded border-2 border-info px-4 pb-[3px] pt-[4px] text-xs font-medium uppercase leading-normal text-info transition duration-150 ease-in-out hover:border-info-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-info-600 focus:border-info-600 focus:text-info-600 focus:outline-none focus:ring-0 active:border-info-700 active:text-info-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
          data-te-ripple-init>
          mais detalhes
        </button>
      </div>
    </div>
  </li>
</div> --}}

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


</ol>

</div>
