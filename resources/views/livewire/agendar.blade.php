<div class="flex flex-col items-center justify-center">
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 

    @foreach(['Em breve', 'Em atraso', 'Concluída'] as $filterOption)
        <div class="m-5">
            <input type="radio"  wire:model.change="option" id="{{ $filterOption }}" value="{{ $filterOption }}" class="peer hidden" />
            <label for="{{ $filterOption }}" class="block cursor-pointer select-none rounded-xl p-2 text-center peer-checked:bg-blue-500 peer-checked:font-bold peer-checked:text-white">
                {{ ucfirst($filterOption) }}
            </label>
        </div>
    @endforeach

<ol  class="border-l-2 mt-5 border-info-100">
    <div
    class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] text-primary motion-reduce:animate-[spin_1.5s_linear_infinite]"
    role="status" wire:loading wire:target="option">
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Loading...</span
    >
  </div>
 @can('pagar',auth()->user())
 
 

 @else
  @foreach($this->agendamentos as $agendamento)
  <div  wire:loading.remove wire:target="option">
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
</div>
@endforeach 


  {{-- <!--Second item-->
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
        <div class="mb-4 flex justify-between">
          <a
            href="#!"
            class="text-sm text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >21 000 Job Seekers</a
          >
          <a
            href="#!"
            class="text-sm text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >12 / 01 / 2022</a
          >
        </div>
        <p class="mb-6 text-neutral-700 dark:text-neutral-200">
          Libero expedita explicabo eius fugiat quia aspernatur autem
          laudantium error architecto recusandae natus sapiente sit nam
          eaque, consectetur porro molestiae ipsam an deleniti.
        </p>
        <button
          type="button"
          class="inline-block rounded bg-info px-4 pb-[5px] pt-[6px] text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#54b4d3] transition duration-150 ease-in-out hover:bg-info-600 hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:bg-info-600 focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:outline-none focus:ring-0 active:bg-info-700 active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(84,180,211,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)]"
          data-te-ripple-init
          data-te-ripple-color="light">
          Preview
        </button>
        <button
          type="button"
          class="inline-block rounded border-2 border-info px-4 pb-[3px] pt-[4px] text-xs font-medium uppercase leading-normal text-info transition duration-150 ease-in-out hover:border-info-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-info-600 focus:border-info-600 focus:text-info-600 focus:outline-none focus:ring-0 active:border-info-700 active:text-info-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
          data-te-ripple-init>
          See demo
        </button>
      </div>
    </div>
  </li>

  <!--Third item-->
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
        <div class="mb-4 flex justify-between">
          <a
            href="#!"
            class="text-sm text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >Awesome Employers</a
          >
          <a
            href="#!"
            class="text-sm text-info transition duration-150 ease-in-out hover:text-info-600 focus:text-info-600 active:text-info-700"
            >21 / 12 / 2021</a
          >
        </div>
        <p class="mb-6 text-neutral-700 dark:text-neutral-200">
          Voluptatibus temporibus esse illum eum aspernatur, fugiat
          suscipit natus! Eum corporis illum nihil officiis tempore.
          Excepturi illo natus libero sit doloremque, laborum molestias
          rerum pariatur quam ipsam necessitatibus incidunt, explicabo.
        </p>
        <button
          type="button"
          class="inline-block rounded bg-info px-4 pb-[5px] pt-[6px] text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#54b4d3] transition duration-150 ease-in-out hover:bg-info-600 hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:bg-info-600 focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] focus:outline-none focus:ring-0 active:bg-info-700 active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.3),0_4px_18px_0_rgba(84,180,211,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(84,180,211,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(84,180,211,0.2),0_4px_18px_0_rgba(84,180,211,0.1)]"
          data-te-ripple-init
          data-te-ripple-color="light">
          Preview
        </button>
        <button
          type="button"
          class="inline-block rounded border-2 border-info px-4 pb-[3px] pt-[4px] text-xs font-medium uppercase leading-normal text-info transition duration-150 ease-in-out hover:border-info-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-info-600 focus:border-info-600 focus:text-info-600 focus:outline-none focus:ring-0 active:border-info-700 active:text-info-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
          data-te-ripple-init>
          See demo
        </button>
      </div>
    </div>
  </li> --}}
</ol>
@endcan
</div>
