<div>
 
  {{--   <form wire:submit="editarBarbeiro"  class="flex flex-col gap-4 justify-center w-[500px] mx-auto mt-5">
        <x-errors />
    <x-select
    label="Selecionar Barbeiro"
    placeholder="Selecionar Barbeiro"
    wire:model.blur="barbeiroModel"
    class="mb-3"
    
    autocomplete="off"
  >
  @foreach($this->barbearia->barbeiros as $barbeiro)
    <x-select.user-option src="/barbearia.avif" label="{{ $barbeiro->name }}" value="{{ $barbeiro->id }}" />
  
    @endforeach
  </x-select>
@if($barbeiroModel)
<div wire:transition class="flex flex-col gap-4">
@foreach($this->allDaysOfWeek as $index => $day)
<x-checkbox id="right-label" label="{{ $day }}"   wire:model="dias.{{ $day }}"  wire:click="toggleCheckbox('{{ $day }}')"/>
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
<x-button  class="mb-3" black label="Editar" spinner="editarBarbeiro" wire:click="editarBarbeiro" />
@endif
</div>
</form> --}}


<!-- Container for demo purpose -->
<div class="container my-24 mx-auto md:px-6 mr-24 max-sm:m-auto">
  <!-- Section: Design Block -->


  <section class="mb-32 text-center">
    <h2 class="mb-32 text-3xl font-bold">
      Gerenciar <u class="text-black dark:text-primary-400">barbeiros</u>
    </h2>

    <div class="grid gap-x-6 md:grid-cols-3 lg:gap-x-12">
      @foreach($this->barbearia->barbeiros as $barbeiro)
      @if($barbeiro->is($editing))

      <div class="mb-24 md:mb-0" wire:key="editar-{{ $barbeiro->id }}">
        <x-modal.card title="Adicionar corte" blur wire:model="corteModal" x-on:corte-salvo.window="close">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <x-input label="Nome"  wire:model="cortename" placeholder="Nome do corte" />
              <x-inputs.currency label="Preço" prefix="R$" thousands="." decimal="," wire:model="currency" />
       
              <div class="col-span-1 sm:col-span-2">
                  <x-input label="Descrição" wire:model="cortedescricao" placeholder="Descrição do corte" />
              </div>
       
           
          </div>
       
          <x-slot name="footer">
              <div class="flex justify-between gap-x-4">
         
       
                  <div class="flex">
                      <x-button flat label="Cancelar" x-on:click="close" />
                      <x-button wire:click="criarCorte({{ $barbeiro }})" spinner primary label="Criar"  />
                  </div>
              </div>
          </x-slot>
      </x-modal.card>
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
            <div class="flex justify-center -mt-[75px]">
                <!-- Imagem com opacidade -->
                <img src="/barbearia.avif"
                    class="mx-auto rounded-full shadow-lg dark:shadow-black/20 w-[150px] h-[150px] object-cover opacity-50" alt="Avatar" />
            </div>
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

        <ul class="mb-6">
          <li
            class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
         Cortes
          </li>
          @foreach($barbeiro->cortes as $corte)
          <li
            class="w-full border-b-2 border-neutral-100 border-opacity-100 py-4 dark:border-opacity-50">
        {{ $corte->nome }} -
       R${{ $corte->preco }}
          </li>
      
      @endforeach
      <button
      type="button"
      x-on:click="$openModal('corteModal')"
      class="inline-block rounded bg-primary px-6 mt-5 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
      
      >
      
    Adicionar corte
    </button>


        </ul>
            
            <ul class="">
         
              <div wire:transition class="flex flex-col gap-4">
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
                <x-button  class="mb-3" black label="Editar" spinner="editarBarbeiro" wire:click="editarBarbeiro({{ $barbeiro->id }})" />
          
                </div>
              </form>
     
            </ul>
          </div>
        </div>
      </div>
      @else
      <div class="mb-24 md:mb-0" wire:key="{{ $barbeiro->id }}">
        <div
          class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
          <div class="flex justify-center">
            <div class="flex justify-center -mt-[75px]">
              <img src="/barbearia.avif"
                class="mx-auto rounded-full shadow-lg dark:shadow-black/20 w-[150px] h-[150px] object-cover" alt="Avatar" />
            </div>
          </div>
          <div class="p-6">
            <h5 class="mb-4 text-lg font-bold">{{ $barbeiro->name }}</h5>
            <p class="mb-6">Frontend Developer</p>
            <ul class="mx-auto flex list-inside justify-center">
              
              <x-button primary label="Editar Barbeiro" spinner="edit({{ $barbeiro->id }})" wire:click="edit({{ $barbeiro->id }})" />
            </ul>
          </div>
        </div>
      </div>
      @endif
@endforeach


    </div>
  </section>
  <!-- Section: Design Block -->
</div>

</div>
