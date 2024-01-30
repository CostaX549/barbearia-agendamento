<div>
  <x-notifications />
    <!-- Container for demo purpose -->
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
                    <strong>R$ 120</strong>
                    <small class="text-base text-neutral-500 dark:text-neutral-300">/ano</small>
                  </h3>
      
                  <button type="button"
                  x-on:click="$openModal('subscriptionModal'); $wire.preferencia = 'anual'"
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
                    @if($existingPlano->inscrito === 0)
                    <strong>R${{ $existingPlano->price + 15 }} </strong>
                    @else 
                    <strong>R${{ $existingPlano->price  }} </strong>
@endif
                    <small class="text-base text-neutral-500 dark:text-neutral-300">/mês</small>
                  </h3>
                  
                  <button
                  href="/subscription-checkout"
                   x-on:click="$openModal('subscriptionModal'); $wire.preferencia = 'mensal'"
                  type="button"
                    class="inline-block w-full rounded bg-primary px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
                    data-te-ripple-init data-te-ripple-color="light">
                  Comprar
                </button>
      
                <x-modal.card title="Selecione um Metódo de Pagamento" wire:model="subscriptionModal" x-on:close-modal.window="close">
             
                  <button wire:click="clickMercadoPagoButton" class="border rounded-lg p-5  @if($isMercadoPagoButtonClicked) border-blue-800 @endif ">
                    <img src="/mercadopago.png" class="w-30 h-30">
                </button>
            
                <button wire:click="clickStripeButton" class="border rounded-lg p-5 mt-10  @if($isStripeButtonClicked) border-blue-800 @endif ">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Unlimited
                      updates
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
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Code examples
                    </li>
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Premium
                      snippets
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
                    <strong>Enterprise</strong>
                  </p>
                  <h3 class="mb-6 text-3xl">
                    <strong>$ 499</strong>
                    <small class="text-base text-neutral-500 dark:text-neutral-300">/year</small>
                  </h3>
                  <button type="button"
                  x-on:click="$openModal('subscriptionModal'); $wire.preferencia = 'semestral'"
                    class="inline-block w-full rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
                    data-te-ripple-init data-te-ripple-color="light">
                    Buy
                  </button>
                </div>
                <div class="p-6">
                  <ol class="list-inside">
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Unlimited
                      updates
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
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Code examples
                    </li>
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Premium
                      snippets
                    </li>
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Premium
                      support
                    </li>
                    <li class="mb-4 flex">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="mr-3 h-5 w-5 text-primary dark:text-primary-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>Drag&amp;Drop
                      builder
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Section: Design Block -->
      </div>
</div>