

<div>

    
  
    
  
    <div class="mb-6">
    
        <div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">
          
          <x-modal.card title="Editar Agendamento" blur  wire:model="agendamentoModal" x-on:abrir-modal.window="open" x-on:agendamento-editado.window="close" x-on:close="$wire.limpar()">
            @if($selectedAgendamento)
            <div class="flex flex-col gap-4 mb-3">
           
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
            </div>
  
    
          
            <livewire:date-picker  wire:model="date"  :selectedAgendamento="$selectedAgendamento" />
             
               
                  <x-slot name="footer">
                      <div class="flex justify-between gap-x-4">
                          <x-button flat negative label="Deletar" spinner="delete({{ $selectedAgendamento->id }})" wire:click="delete({{ $selectedAgendamento->id }})" />
               
                          <div class="flex">
                              <x-button flat label="Cancelar" x-on:click="close" />
                              <x-button primary label="Editar"  spinner="editar({{ $selectedAgendamento->id }})" x-on:click="$wire.editar({{ $selectedAgendamento->id }})"  />
                          </div>
                      </div>
                  </x-slot>
                  @endif
              </x-modal.card>
        
        
      @foreach($this->agendamentos as $agendamento )
      
 
   
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

   