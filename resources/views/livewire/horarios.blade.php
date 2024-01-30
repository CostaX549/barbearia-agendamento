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

      <livewire:barbeiro-editing :barbeiro="$barbeiro" :key="'editar-' . $barbeiro->id" />
      @else
      <div class="mb-24 md:mb-0" wire:key="{{ $barbeiro->id }}">
        <div
          class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
          <div class="flex justify-center">
            <div class="flex justify-center -mt-[75px]">
              <img src="{{ asset('storage/' . $barbeiro->avatar)}}"
                class="mx-auto rounded-full shadow-lg dark:shadow-black/20 w-[150px] h-[150px] object-cover" alt="Avatar" />
            </div>
          </div>
          <div class="p-6">
            <h5 class="mb-4 text-lg font-bold">{{ $barbeiro->name }}</h5>
            <p class="mb-6">Frontend Developer</p>
            <ul class="mx-auto flex flex-col gap-4 list-inside justify-center">
              
              <x-button primary label="Editar Barbeiro" spinner="edit({{ $barbeiro->id }})" wire:click="edit({{ $barbeiro->id }})" />
                <a
                href="horarios/calendario/{{ $barbeiro->id }}"
                wire:navigate
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
                >Gerenciar Calendário</a
              >
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
