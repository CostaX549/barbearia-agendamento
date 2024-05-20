<div x-data="{ previewImagem: null, showForm: false }" class="px-2">
  <label class="mb-5 mt-5 block text-xl font-semibold text-black">
    Métodos de pagamento e suas faturas na máquina eletrônica
  </label>

  <x-select
    label="Métodos de pagamento aceitos na barbearia"
    placeholder="Selecionar métodos"
    wire:ignore 
    wire:model.blur="state.payments"
  
   
    class="mb-3"
    multiselect
    autocomplete="off"
  > 
  @foreach(["Cartão de Crédito", "Cartão de Débito", "Dinheiro", "Pix", "Boleto"] as $option)
  <x-select.option value="{{$option}}" label={{$option}}/>
   
@endforeach
</x-select>

  <select wire:model.live="state.payments" multiple>
    @foreach(["Cartão de Crédito", "Cartão de Débito", "Dinheiro", "Pix", "Boleto"] as $option)
        <option value="{{$option}}">{{$option}}</option>
    @endforeach
</select>


  @if(in_array('Cartão de Crédito', $this->state['payments']) || in_array('Cartão de Débito', $this->state['payments']))
    <x-button  @click="showForm = true" label="Adicionar Maquininha" />
    <template x-if="showForm">
      <form>
        <div class="mb-6 mt-6"> 
           <input
              type="text"
              placeholder="Nome da Maquininha"
              wire:model="state.maquininhaname"
              class="
              w-full
              rounded
              py-3
              px-[14px]
              text-body-color text-base
              border border-[f0f0f0]
              outline-none
              focus-visible:shadow-none
              focus:border-primary
              "
              />
        </div>

      
        <div class="mb-6">
           <input
              type="text"
              placeholder="Taxa de Desconto no Débito"
              wire:model="state.maquininhadebito"
              class="
              w-full
              rounded
              py-3
              px-[14px]
              text-body-color text-base
              border border-[f0f0f0]
              outline-none
              focus-visible:shadow-none
              focus:border-primary
              "
              />
        </div>
    
    
     
        <div class="mb-6">
           <input
              type="email"
              placeholder="Taxa de Desconto no Crédito"
              wire:model="state.maquininhacredito"
              class="
              w-full
              rounded
              py-3
              px-[14px]
              text-body-color text-base
              border border-[f0f0f0]
              outline-none
              focus-visible:shadow-none
              focus:border-primary
              "
              />
        </div>
     

     
     
     </form>
    </template>
  @endif
  
 
</div>
