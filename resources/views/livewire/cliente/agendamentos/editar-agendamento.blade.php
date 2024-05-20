
    <x-modal.card title="Editar Agendamento" blur  wire:model="agendamentoModal-{{ $agendamento->id }}"  x-on:agendamento-editado.window="close">
  
        <div class="flex flex-col gap-4 mb-3" wire:key="view-{{ $agendamento->id }}">
       
       
      
      @foreach($agendamento->colaborador->cortes as $corte)
          <x-checkbox
              md
              id="color-secondary"
              secondary
              label="{{ $corte->corte->nome }} - R${{ $corte->corte->preco }}"
              wire:model="cortes"
              class="mb-3"
              value="{{ $corte->id }}"
              autocomplete="off"
          />
      @endforeach
        </div>

@php 
 $key = 'date-' . $this->agendamento->id;
@endphp
      
        <livewire:cliente.agendamentos.date-picker wire:model="date" :barbeiroSelecionado="$agendamento->colaborador" :key="$key" :selectedAgendamento="$agendamento" />
        @if(session('error'))
        <div x-data="{ isOpen: true }" x-on:mostrar.window="isOpen = true" x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-5" role="alert">
            <strong class="font-bold">Erro</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
            <span @click="isOpen = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
        @endif
           
              <x-slot name="footer">
                  <div class="flex justify-between gap-x-4">
                      <x-button flat negative label="Deletar" spinner="delete({{ $agendamento->id }})" wire:click="delete({{ $agendamento->id }})" />
           
                      <div class="flex">
                          <x-button flat label="Cancelar" x-on:click="close" />
                          <x-button primary label="Editar"  spinner="editar({{ $agendamento->id }})" x-on:click="$wire.editar({{ $agendamento->id }})"  />
                      </div>
                  </div>
              </x-slot>
        
          </x-modal.card>
