
@use('App\Models\Plan')
<div >

<!--Tabs navigation-->

<ul
  class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0"
  role="tablist"
  id="myTab"
  data-te-nav-ref>
  <li role="presentation" class="flex-auto text-center"
       wire:ignore.self
  >
    <a
      wire:ignore.self
      href="#tabs-home01"
      class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-home01"
      data-te-nav-active
      role="tab"
      aria-controls="tabs-home01"
      aria-selected="true"
      >Barbearias</a
    >
  </li>
  <li wire:ignore.self role="presentation" class="flex-auto text-center">
    <a
     wire:ignore.self
      href="#tabs-profile01"
      class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-profile01"
      role="tab"
      aria-controls="tabs-profile01"
      aria-selected="false"
      >Crie sua barbearia</a
    >
  </li>
  <li  class="flex-auto text-center">
    <a
   
      href="/meus-agendamentos"
      wire:navigate
      class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      
      
    
     
      
      >Agenda</a
    >
  </li>
 




   @if(auth()->user()->barbearias->count()>0)
   <li wire:ignore.self role="presentation" class="flex-auto text-center">
    <a
      wire:ignore.self
      href="#tabs-messages01"
      class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-messages01"
      role="tab"
      aria-controls="tabs-messages01"
      aria-selected="false"
      >Suas Barbearias</a
    >
  </li>    
   @endif
  
</ul>

<!--Tabs content-->
<div class="mb-6">
  <div
    class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="tabs-home01"
    role="tabpanel"
    aria-labelledby="tabs-home-tab01"
    data-te-tab-active
    wire:ignore.self
    >

<div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">

  @php
  
  $barbeariasOrdenadas = $this->barbearias->sortByDesc(function ($barbearia) {
      return $barbearia->barbeiros->pluck('agendamentos')->flatten()->count();
  });
@endphp

@foreach($barbeariasOrdenadas as $barbearia)

<div
class="mx-auto mb-8 sm:mb-0  block rounded-lg max-w-[450px] bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
<div
  class="  relative   overflow-hidden bg-cover bg-no-repeat"
  data-te-ripple-init
  data-te-ripple-color="light">
  <img
    class="rounded-t-lg  object-cover "
    src="{{ asset('storage/' . $barbearia->imagem) }}"
   style="width: 450px; height: 317px;"
    alt="" />
  <a href="/{{$barbearia->slug}}"
    wire:navigate
    >
    <div
      class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
  </a>
</div>
<div class="p-6">
  <h5
    class="mb-2 text-xl font-medium leading-tight text-neutral-800">
  {{ $barbearia->nome }}
  </h5>
  <p class="mb-2 text-base text-neutral-600">
   Cep:   {{ $barbearia->cep }}
 
  
  </p>
  <p class="mb-2 text-base text-neutral-600">
   
    Rua:   {{ $barbearia->rua }}
   </p>
   <p class="mb-2 text-base text-neutral-600">
   
    Cidade:   {{ $barbearia->cidade }}
   </p>

   <p class="mb-4 text-base text-neutral-600">
   
    Estado:   {{ $barbearia->estado }}
   </p>
  <a
  type="button"
  data-te-ripple-init
  data-te-ripple-color="light"
  href="/{{$barbearia->slug}}"
  wire:navigate
  class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
 Conhecer Agora
</a>
</div>
</div>
@endforeach
</div>
  </div>

  <div
    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="tabs-profile01"
    role="tabpanel"
    aria-labelledby="tabs-profile-tab01"
    wire:ignore.self
    >
   
{{-- <form wire:submit = "criarBarbearia" class="mx-auto  max-w-[800px]">
  
    <div class="flex flex-col gap-2">
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Nome da Barbearia" wire:model="name">
       
   
   
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="CEP" wire:model.blur="cep" >
  
   
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Bairro" wire:model="bairro">

    
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Rua" wire:model="rua">
   
    
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Complemento" wire:model="complemento">

  
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Cidade" wire:model="cidade">
       
        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="Estado" wire:model="estado">

        <input type="text" class="peer py-3 pe-0  block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-xl focus:border-t-transparent focus:border-x-transparent focus:border-b-black focus:ring-0 disabled:opacity-50 disabled:pointer-events-none" placeholder="URL" wire:model="slug">
      </div>
   

      <label class="mb-5 mt-5 block text-xl font-semibold text-black">
        Enviar Imagem
      </label>

    <label
    for="file"
    class=" cursor-pointer relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center"
  >
  <input type="file" id="file"  wire:model="imagem" class="sr-only" >

     <span
     class="hover:bg-gray-100 inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-black]"
   >
    Enviar
   </span>



    



  </label> 
<div class="flex justify-center" wire:loading wire:target="imagem"><div
  class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
  role="status">
  <span
    class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
    >Loading...</span
  >
</div></div>
@if($imagem)
  <div class="mb-4 mt-3">
    <img
      src="{{ $imagem->temporaryUrl() }}"
      class="h-auto max-w-full rounded-lg mx-auto"
      alt="" />
  </div>
  @endif
  <button
  type="submit"
  class="inline-block w-full mt-3 rounded bg-neutral-800 px-6 pb-5 pt-5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)]">
  Criar Barbearia
</button>
</form> --}}
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 

<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<!-- Stepper -->
<!-- Container for demo purpose -->
@php 
$this->plan = Plan::where('user_id', auth()->user()->id)->first();
@endphp

@can('inscrito', $this->plan)
<div class="container my-5 mx-auto md:px-6 ">
  <!-- Section: Design Block -->
  <section class="mb-3">
    <div
      class="relative h-[300px] rounded-lg overflow-hidden bg-cover bg-[50%] bg-no-repeat" style="background-image: url('{{ asset('fundopreto.jpg') }}')">
    </div>
    <div class="container px-6 md:px-12">
      <div class="block sm:w-full  rounded-lg bg-[hsla(0,0%,100%,0.7)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.7)] dark:shadow-black/20 md:py-16 md:px-12 -mt-[100px] backdrop-blur-[30px] ">
       
        <div class="mx-auto w-[100%]">
          <livewire:user-wizard user-id="3"/>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
</div>
<!-- Container for demo purpose -->
@else
<div class="container my-24 mx-auto md:px-6">
  <!-- Section: Design Block -->
  <section class="mb-32">
    <h2 class="mb-12 text-center text-3xl font-bold">Crie sua barbearia</h2>

    <div class="grid gap-6 lg:grid-cols-3 lg:gap-x-12">
      <div class="mb-6 lg:mb-0">
        <div
          class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
          <div class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
            <p class="mb-4 text-sm uppercase">
              <strong>Básico</strong>
            </p>
            <h3 class="mb-6 text-3xl">
              <strong>R$ 180</strong>
              <small class="text-base text-neutral-500 dark:text-neutral-300">/ano</small>
            </h3>

            <button type="button"
            x-on:click="$openModal('subscriptionModal');$wire.preferencia = 'anual'"
              class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
              data-te-ripple-init data-te-ripple-color="light">
             Comprar
            </button>
          </div>
          <div class="p-6">
            <ol class="list-inside">
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Crie
               barbearias
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Git
                repository
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>npm
                installation
              </li>
            </ol>
          </div>
        </div>
      </div>

      <div class="mb-6 lg:mb-0">
        <div
          class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
          <div class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
            <p class="mb-4 text-sm uppercase">
              <strong>Recomendado</strong>
            </p>
            <h3 class="mb-6 text-3xl">
              <strong>R$15</strong>
              <small class="text-base text-neutral-500 dark:text-neutral-300">/mês</small>
            </h3>
            
            <button
            href="/subscription-checkout"
             x-on:click="$openModal('subscriptionModal');$wire.preferencia = 'mensal'"
              
            type="button"
              class="inline-block w-full rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
              data-te-ripple-init data-te-ripple-color="light">
            Comprar
          </button>
           
          <x-modal.card title="Selecione um Metódo de Pagamento" wire:model="subscriptionModal">
       
            <button class="border rounded-lg p-5  border-blue-800 ">
              <img src="/mercadopago.png" class="w-30 h-30">
          </button>
      
          <button  class="border rounded-lg p-5 mt-10  border-blue-800 ">
              <img src="/STRIPE.png" class="w-[425px] h-[125px] object-cover">
          </button>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <x-button flat label="Cancelar" x-on:click="close" />
                        <x-button primary label="Pagar" spinner="pagar" wire:click="pagar" />
                    </div>
                </x-slot>
           
        </x-modal.card>
          </div>
          <div class="p-6">
            <ol class="list-inside">
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Crie
               barbearias
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Git
                repository
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>npm
                installation
              </li>
            </ol>
          </div>
        </div>

      
      </div>
      <div class="mb-6 lg:mb-0">
        <div
          class="block h-full rounded-lg bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
          <div class="border-b-2 border-neutral-100 border-opacity-100 p-6 text-center dark:border-opacity-10">
            <p class="mb-4 text-sm uppercase">
              <strong>Recomendado</strong>
            </p>
            <h3 class="mb-6 text-3xl">
              <strong>R$90</strong>
              <small class="text-base text-neutral-500 dark:text-neutral-300">/semestre</small>
            </h3>
            
           
            <button type="button"
            x-on:click="$openModal('subscriptionModal');$wire.preferencia = 'semestral'"
              class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
              data-te-ripple-init data-te-ripple-color="light">
             Comprar
            </button>
          
          </div>
          <div class="p-6">
            <ol class="list-inside">
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Crie
               barbearias
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Git
                repository
              </li>
              <li class="mb-4 flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>npm
                installation
              </li>
            </ol>
          </div>
        </div>
      
     
@endcan




  </div>
  <div
    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="tabs-messages01"
    role="tabpanel"
    aria-labelledby="tabs-profile-tab01"
    wire:ignore.self
    >  
    <div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">
        @foreach(auth()->user()->barbearias as $barbearia)
        <div
        class="mx-auto mb-8 sm:mb-0  block rounded-lg max-w-[450px] bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
        <div
          class="  relative   overflow-hidden bg-cover bg-no-repeat"
          data-te-ripple-init
          data-te-ripple-color="light">
          <img
            class="rounded-t-lg  object-cover "
            src="{{ asset('storage/' . $barbearia->imagem) }}"
           style="width: 450px; height: 317px;"
            alt="" />
          <a href="/{{$barbearia->slug}}"
            wire:navigate
            >
            <div
              class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
          </a>
        </div>
        <div class="p-6">
          <h5
            class="mb-2 text-xl font-medium leading-tight text-neutral-800">
          {{ $barbearia->nome }}
          </h5>
          <p class="mb-2 text-base text-neutral-600">
           Cep:   {{ $barbearia->cep }}
         
          
          </p>
          <p class="mb-2 text-base text-neutral-600">
           
            Rua:   {{ $barbearia->rua }}
           </p>
           <p class="mb-2 text-base text-neutral-600">
           
            Cidade:   {{ $barbearia->cidade }}
           </p>
        
           <p class="mb-4 text-base text-neutral-600">
           
            Estado:   {{ $barbearia->estado }}
           </p>
          <a
          type="button"
          data-te-ripple-init
          data-te-ripple-color="light"
          href="/{{$barbearia->slug}}"
          wire:navigate
          class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
         Ver Barbearia
        </a>
        </div>
        </div>
        @endforeach
  
    </div>
          </div>
       
       
 

   
  {{--   <div
    class="bg-neutral-100 p-12 text-center text-neutral-700">
    <h2 class="mb-4 text-4xl font-semibold">Barbearia</h2>
    <h4 class="mb-6 text-xl font-semibold">John Alisson</h4>
    <a
      type="button"
      data-te-ripple-init
      data-te-ripple-color="light"
      href="/agendar"
      wire:navigate
      class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
       Agendar Agora
</a>
  </div> --}}


</div>