<div>
    <div class="flex flex-wrap -mx-3 p-5">
        <div class="flex-none w-full max-w-full px-3 ">
          <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6 class="dark:text-white">Compras</h6>
              <span class="bg-gradient-to-tl from-emerald-500 to-teal-400  cursor-pointer 0 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" wire:click="$set('comprarModal', true)" wire:loading.attr="disabled" wire:loading.class="opacity-50" ">Adicionar Compra</span>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
              <div class="p-0 overflow-x-auto">
             
                <table class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                  <thead class="align-bottom">
                    <tr>
                      <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Data</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Produto(s)</th>
                      <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Quantidade</th>
                      <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ações</th>
                      <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                    </tr>
                  </thead>
                  <tbody class="border-t">
            @foreach($this->compras as $compra)
                    <tr>
                      <td class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                          <div class="flex px-2">
                              <div>
                                <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-calendar-grid-58 mr-2"></i>
                              </div>
                              <div class="my-auto">
                                  <h6 class="mb-0 text-sm leading-normal dark:text-white">{{  $compra->created_at }}</h6>
                              </div>
                          </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                          <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">
                            @foreach($compra->produtos as $produto)
                            <p>Nome: {{ $produto->nome }}</p>
                            @endforeach
                          </p>
                      </td>
                      <td class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                        <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                           
                        </span>
                    </td>
                      <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                        
                        <span class="bg-gradient-to-tl from-red-600 to-orange-600  cursor-pointer 0 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" wire:click="cancelar()" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="cancelar()">Cancelar</span>
                       
                  
                   
                      <span class="bg-gradient-to-tl from-emerald-500 to-teal-400  cursor-pointer 0 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" wire:click="concluir()" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="concluir()">Concluir</span>
                        
                           
    
                         
                        
                      </td>
                      <td class="p-2 align-middle bg-transparent whitespace-nowrap shadow-transparent">
                          <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400">
                              <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                          </button>
                      </td>
                  </tr>
                  @endforeach
                    
                   
    
                  </tbody>
                  <div class="flex justify-center pb-5">
                  
    
    </div>
                </table>
    
                
              
              </div>
    
              
             
            </div>
          </div>
<x-modal.card title="Adicionar Compra" blur wire:model="comprarModal">
           <x-select
    label="Search a User"
    placeholder="Select some user"
    :async-data="route('api.clientes.index', $barbearia)"
    option-label="name"
    wire:model.blur="cliente"
    
    option-value="id"
/>

<x-select
label="Search Product"
placeholder="Select some product"
:async-data="route('api.produtos.index', $barbearia)"
option-label="nome"
class="mt-4"
wire:model.blur="produtos"
multiselect
option-value="id"
/>

   @foreach($produtos as $index => $produtoId)
    @php
        
        $produto = app(\App\Models\Produto::class)->find($produtoId);
    @endphp
   <div class="mt-4">
    <label for="quantidade" class="mt-4 block font-medium text-sm text-gray-700">Quantity for {{$produto->nome}}</label>
    <input type="number" id="quantidade" wire:model="quantidade.{{ $index }}" class=" focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
</div>
   @endforeach
    
   <x-slot name="footer">
    <div class="flex justify-between gap-x-4">
       
        <div class="flex">
            <x-button flat label="Cancelar" x-on:click="close" />
            <x-button primary label="Editar"  spinner="realizarCompra" wire:click="realizarCompra"  />
        </div>
    </div>
</x-slot>
</x-modal.card>
      
</div>
