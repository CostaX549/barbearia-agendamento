<div>
    
 @use(Carbon\Carbon)


    
 


<!--Large modal-->
<div
  data-te-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
 @if($cliente) 
 id="exampleModalLg-{{ $cliente->id }}"
  @else 
  id="exampleModalLg"
 @endif
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
       
          id="fechar"
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
      
      @foreach($this->barbearia->barbeiros as $barbeiro)
      
        <x-select.user-option src="{{ $barbeiro->user->profile_photo_url }}" label="{{ $barbeiro->user->name }}" value="{{ $barbeiro->id }}" />
      
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
      wire:model="cortes"
      
      class="mb-3"
      autocomplete="off"
      >
      @foreach($this->barbeiroSelecionado->cortes as $corte)
      <x-select.user-option src="{{ $this->barbeiroSelecionado->user->profile_photo_url }}" label="{{ $corte->corte->nome }} - R${{ $corte->corte->preco }}" value="{{ $corte->id }}" />
      
      @endforeach
      </x-select>
      <x-select
      label="Método de Pagamento"
   
      placeholder="Selecionar Método de Pagamento"
      wire:model="paymentMethod"
      :options="$this->barbeiroSelecionado->payment_methods_allowed"
      class="mb-3"
      autocomplete="off"
  />

 
      
      <livewire:cliente.agendamentos.date-picker  wire:model="date" :formattedDates="$formattedDates" :barbeiroSelecionado="$barbeiroSelecionado" :key="$barbeiroSelecionado->id" />
      
                     
        @if(session('error'))
        <div x-data="{ isOpen: true }" x-on:mostrar.window="isOpen = true" x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5" role="alert">
            <strong class="font-bold">Erro</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span @click="isOpen = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
        @endif
<div class="mt-3">
        @if(!auth()->user()->phone)
        <x-inputs.maskable
    label="Adicione o Telefone apenas uma vez"
   
    wire:model="phone"
    mask="(##) #####-####"
    placeholder="Phone number"
    
/>
        @else
             <p>{{auth()->user()->phone}}</p>
             @if(!$this->change)
              <button wire:click="change">Trocar telefone</button>

              @else
              <x-inputs.maskable
    label="Troque seu telefone"
    mask="(##) #####-####"
    placeholder="Phone number"
    
/>
                     <button wire:click = "change">Trocar</button>
                       <button wire:click= "change">Voltar</button>
                 @endif
      </div>
               
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