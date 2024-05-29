<div x-data="{ previewImagem: null, showForm: false }" class="px-2">
  <label class="mb-5 mt-5 block text-xl font-semibold text-black">
    Métodos de pagamento e suas faturas na máquina eletrônica
  </label>

 
  

<ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
    @foreach(["Cartão de Crédito", "Cartão de Débito", "Dinheiro", "Pix", "Boleto"] as $tech)
    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
        <div class="flex items-center ps-3">
            <input    wire:model.blur="state.payments" id="{{ strtolower($tech) }}-checkbox" type="checkbox" value="{{ $tech }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="{{ strtolower($tech) }}-checkbox" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tech }}</label>
        </div>
    </li>
    @endforeach
</ul>


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
