@session("erro")
<div
class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700"
role="alert">
     {{$value}}
</div>
@endsession


<div class="px-2">

    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="CPF/CNPJ" wire:model="state.cpf">
    
    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nome da Barbearia" wire:model="state.name">
       
   
   
    <div class="flex items-center">
        <input type="text" class="peer py-3 pe-0 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="CEP" wire:model.blur="state.cep">
        
        <div class="ml-2" wire:loading wire:target="state.cep">
            <div class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]" role="status">
                <span class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]">Loading...</span>
            </div>
        </div>
    </div>

    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Bairro" wire:model="state.bairro">


    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Rua" wire:model="state.rua">


    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Complemento" wire:model="state.complemento">


    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Cidade" wire:model="state.cidade">
   
    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Estado" wire:model="state.estado">

    <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="URL" wire:model="state.slug">


</div>