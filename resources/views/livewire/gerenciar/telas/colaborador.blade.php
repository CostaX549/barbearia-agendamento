<div class="w-full px-6 py-6 mx-auto">
    <!-- content -->

    <div class="flex flex-wrap -mx-3">
      <div class="max-w-full px-3 lg:w-2/3 lg:flex-none">
        <div class="flex flex-wrap -mx-3">
       
       @php 
             
             
         $firstCard =  auth()->user()->getMercadoPagoCards()[0] ?? [];
       @endphp
          @if($firstCard)
   
          <div class="w-full max-w-full px-3 mb-6 xl:mb-0 xl:w-1/2 xl:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
              <div class="relative overflow-hidden rounded-2xl" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg')">
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 opacity-80"></span>
                <div class="relative z-10 flex-auto p-4">
                  <i class="p-2 text-white fas fa-wifi"></i>
                  <h5 class="pb-2 mt-6 mb-12 text-white">{{ $firstCard->first_six_digits }}&nbsp;&nbsp;&nbsp;*****&nbsp;&nbsp;&nbsp;*****&nbsp;&nbsp;&nbsp;{{ $firstCard->last_four_digits }}</h5>
                  <div class="flex">
                    <div class="flex">
                      <div class="mr-6">
                        <p class="mb-0 text-sm leading-normal text-white opacity-80">Card Holder</p>
                        <h6 class="mb-0 text-white">{{ $firstCard->cardholder->name}}</h6>
                      </div>
                      <div>
                        <p class="mb-0 text-sm leading-normal text-white opacity-80">Expires</p>
                        <h6 class="mb-0 text-white">11/22</h6>
                      </div>
                    </div>
                    <div class="flex items-end justify-end w-1/5 ml-auto">
                      <img class="w-3/5 object-cover mt-2" src="{{ $firstCard->payment_method->thumbnail }}" alt="logo" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          <div class="w-full max-w-full px-3 xl:w-1/2 xl:flex-none">
            <div class="flex flex-wrap -mx-3">
              <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="p-4 mx-6 mb-0 text-center border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="w-16 h-16 text-center bg-center shadow-sm icon bg-gradient-to-tl from-blue-500 to-violet-500 rounded-xl">
                      <i class="relative text-xl leading-none text-white opacity-100 fas fa-landmark top-31/100"></i>
                    </div>
                  </div>
                  <div class="flex-auto p-4 pt-0 text-center">
                    <h6 class="mb-0 text-center dark:text-white">Salary</h6>
                    <span class="text-xs leading-tight dark:text-white dark:opacity-80">Belong Interactive</span>
                    <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
                    <h5 class="mb-0 dark:text-white">+$2000</h5>
                  </div>
                </div>
              </div>
              <div class="w-full max-w-full px-3 mt-6 md:mt-0 md:w-1/2 md:flex-none">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                  <div class="p-4 mx-6 mb-0 text-center border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="w-16 h-16 text-center bg-center shadow-sm icon bg-gradient-to-tl from-blue-500 to-violet-500 rounded-xl">
                      <i class="relative text-xl leading-none text-white opacity-100 fab fa-paypal top-31/100"></i>
                    </div>
                  </div>
                  <div class="flex-auto p-4 pt-0 text-center">
                    <h6 class="mb-0 text-center dark:text-white">Paypal</h6>
                    <span class="text-xs leading-tight dark:text-white dark:opacity-80">Freelance Payment</span>
                    <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
                    <h5 class="mb-0 dark:text-white">$455.00</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="max-w-full px-3 mb-6 lg:mb-0 lg:w-full lg:flex-none">
            <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                  <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                    <h6 class="mb-0 dark:text-white">Cartões Salvos na Sua Conta</h6>
                  </div>
                  <div class="flex-none w-1/2 max-w-full px-3 text-right">
                    <button x-on:click="$openModal('cardModal')" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 hover:shadow-xs active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25" href="javascript:;"> <i class="fas fa-plus"> </i>&nbsp;&nbsp;Adicionar Novo Cartão</button>
                  </div>
                </div>
              </div>
              <x-modal blur wire:model="cardModal">
                <x-card title="Consent Terms">
                  <div id="cardPaymentBrick_container"  x-data="mercadoPagoIntegration" x-init="initMercadoPago()"> </div>
                
                    <x-slot name="footer">
                        <div class="flex justify-end gap-x-4">
                            <x-button flat label="Cancel" x-on:click="close" />
                            <x-button primary label="I Agree" />
                        </div>
                    </x-slot>
                </x-card>
            </x-modal>


              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  @forelse(auth()->user()->getMercadoPagoCards() as $cartao)
                
             
                  <div class="max-w-full px-3 mb-6 md:mb-0 md:w-1/2 md:flex-none" wire:key="{{ $cartao->id }}">
                    <div class="relative flex flex-row items-center flex-auto min-w-0 p-6 break-words bg-transparent border border-solid shadow-none md-max:overflow-auto rounded-xl border-slate-100 dark:border-slate-700 bg-clip-border">
                      <img class="mb-0 mr-4 w-1/10 object-cover" src="{{ $cartao->payment_method->thumbnail }}" alt="logo" />
                      <h6 class="mb-0 dark:text-white">{{ $cartao->first_six_digits }}&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;{{ $cartao->last_four_digits }}</h6>
                      <i class="ml-auto cursor-pointer fas fa-pencil-alt text-slate-700" data-target="tooltip_trigger" data-placement="top"></i>
                      <div data-target="tooltip" class="hidden px-2 py-1 text-sm text-white bg-black rounded-lg">
                        Edit Card
                        <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                      </div>
                    </div>
                  </div>
              
                  @empty 
                  <h1 class="p-5 text-xl font-semibold">Nenhum cartão adicionado.</h1>
                  @endforelse
               
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
        <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="p-4 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex flex-wrap -mx-3">
              <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                <h6 class="mb-0 dark:text-white">Faturas</h6>
              </div>
              <div class="flex-none w-1/2 max-w-full px-3 text-right">
                <button class="inline-block px-8 py-2 mb-0 text-xs font-bold leading-normal text-center text-blue-500 align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer bg-150 active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25 hover:opacity-75">View All</button>
              </div>
            </div>
          </div>
          <div class="flex-auto p-4 pb-0">
            <ul class="flex flex-col pl-0 mb-0 rounded-lg max-h-[300px] overflow-auto">
           
              @foreach($faturas as $fatura)
              
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 rounded-t-inherit text-inherit rounded-xl">
                <div class="flex flex-col">
                  <h6 class="mb-1 text-sm font-semibold leading-normal dark:text-white text-slate-700">{{ isset($fatura["debit_date"]) ? \Carbon\Carbon::parse($fatura['debit_date'])->format('d/m/Y H:i') : null }}</h6>
                  <span class="text-xs leading-tight dark:text-white dark:opacity-80">#{{ $fatura['id'] }}</span>
                </div>
                <div class="flex items-center text-sm leading-normal dark:text-white/80">
                R${{ $fatura['transaction_amount'] }}
                  <button class="dark:text-white inline-block px-0 py-2.5 mb-0 ml-6 font-bold leading-normal text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer ease-in bg-150 text-sm active:opacity-85 hover:-translate-y-px tracking-tight-rem bg-x-25 text-slate-700"><i class="mr-1 text-lg leading-none fas fa-file-pdf"></i> PDF</button>
                </div>
              </li>
           @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
            <h6 class="mb-0 dark:text-white">Contratados</h6>
          </div>
          <div class="flex-auto p-4 pt-6">
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
         @foreach($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro)
             @if(!$barbeiro->is($isEditing))
              <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50 dark:bg-slate-850" wire:key="{{ $barbeiro->id }}">
                <div class="flex flex-col">
                  <h6 class="mb-4 text-sm leading-normal dark:text-white">{{  $barbeiro->user->name }} @if($barbeiro->user->id == auth()->user()->id) (Você mesmo) @endif</h6>
                  <span class="mb-2 text-xs leading-tight dark:text-white/80">Preço: <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">R${{ $barbeiro?->price?->value }}/{{ $barbeiro?->price?->name }}</span></span>
                  <span class="mb-2 text-xs leading-tight dark:text-white/80">Email: <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $barbeiro->user->email }}</span></span>
                  <span class="mb-2 text-xs leading-tight dark:text-white/80">Método de Pagamento: <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $barbeiro->payment_method?->value }}</span></span>
                  <span class="mb-2 text-xs leading-tight dark:text-white/80">Próxima Cobrança: <span class="font-semibold text-slate-700 dark:text-white sm:ml-2">{{ $barbeiro->plan_ends_at ? $barbeiro->plan_ends_at->format('d-m-Y') : null }}</span></span>
                 
                </div>
                <div class="ml-auto text-right">
                  @if($barbeiro->payment_method === null)
                  <a   class="relative z-10 inline-block px-4 py-2.5 mb-0 font-bold text-center text-transparent align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-normal text-sm ease-in bg-150 bg-gradient-to-tl from-red-600 to-orange-600 hover:-translate-y-px active:opacity-85 bg-x-25 bg-clip-text" href="javascript:;"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-orange-600 bg-x-25 bg-clip-text"></i>Reativar Contrato</a>
                 @else 
                 <a wire:click="abrirModal({{ $barbeiro->id }})"  class="relative z-10 inline-block px-4 py-2.5 mb-0 font-bold text-center text-transparent align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-normal text-sm ease-in bg-150 bg-gradient-to-tl from-red-600 to-orange-600 hover:-translate-y-px active:opacity-85 bg-x-25 bg-clip-text" href="javascript:;"><i class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-orange-600 bg-x-25 bg-clip-text"></i>Cancelar</a>
                 @endif
                  <a class="inline-block dark:text-white px-4 py-2.5 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-normal text-sm ease-in bg-150 hover:-translate-y-px active:opacity-85 bg-x-25 text-slate-700" wire:click="edit({{ $barbeiro->id }})"><i class="mr-2 fas fa-pencil-alt text-slate-700" aria-hidden="true"></i>Editar</a>
                </div>
              </li>

           
              @if($barbeiro->trashed() && $barbeiro->payment_method?->value === 'PIX')
              <div  x-data="statusScreen()" x-init="initStatusScreen()" wire:ignore id="statusScreenBrick_container"></div>
              @script
              <script>
                  Alpine.data('statusScreen', () => ({
                      initStatusScreen() {
                       
                       
                                  const mp = new MercadoPago('APP_USR-6c284546-a6b3-429f-8181-2a69a2c4f764', {
                                      locale: 'pt-br'
                                  });
                                  const bricksBuilder = mp.bricks();
              
                                  const renderStatusScreenBrick = async (bricksBuilder) => {
                                      const settings = {
                                          initialization: {
                                              paymentId: @json($barbeiro->payment_id),
                                          },
                                          customization: {
                                              visual: {
                                                  hideStatusDetails: true,
                                                  hideTransactionDate: true,
                                                  style: {
                                                      theme: 'default',
                                                  }
                                              },
                                          },
                                          callbacks: {
                                              onReady: () => {
                                                  // Callback chamado quando o Brick estiver pronto
                                              },
                                              onError: (error) => {
                                                 console.log(error)
                                              },
                                          },
                                      };
                                      window.statusScreenBrickController = await bricksBuilder.create('statusScreen', 'statusScreenBrick_container', settings);
                                  };
                                  renderStatusScreenBrick(bricksBuilder);
                            
                        
                      },
                  }));
              </script>
              @endscript


           
              @elseif($barbeiro->payment_method?->value === 'Boleto')
                 <div  x-data="statusScreen()" x-init="initStatusScreen()" wire:ignore id="statusScreenBrick_container"></div>
              @script
              <script>
                  Alpine.data('statusScreen', () => ({
                      initStatusScreen() {
                       
                       
                                  const mp = new MercadoPago('APP_USR-6c284546-a6b3-429f-8181-2a69a2c4f764', {
                                      locale: 'pt-br'
                                  });
                                  const bricksBuilder = mp.bricks();
              
                                  const renderStatusScreenBrick = async (bricksBuilder) => {
                                      const settings = {
                                          initialization: {
                                              paymentId: @json($barbeiro->payment_id),
                                          },
                                          customization: {
                                              visual: {
                                                  hideStatusDetails: true,
                                                  hideTransactionDate: true,
                                                  style: {
                                                      theme: 'default',
                                                  }
                                              },
                                          },
                                          callbacks: {
                                              onReady: () => {
                                                  // Callback chamado quando o Brick estiver pronto
                                              },
                                              onError: (error) => {
                                                  // Callback chamado para todos os casos de erro do Brick
                                              },
                                          },
                                      };
                                      window.statusScreenBrickController = await bricksBuilder.create('statusScreen', 'statusScreenBrick_container', settings);
                                  };
                                  renderStatusScreenBrick(bricksBuilder);
                            
                        
                      },
                  }));
              </script>
              @endscript
              @endif

              @else 
                <livewire:gerenciar.contratos.edit-contrato :barbeiro="$barbeiro" :key="'editar-' . $barbeiro->id" />
              @endif
              @endforeach
            
            
            </ul>
          </div>
        </div>
      </div>
      <x-modal  blur wire:model="simpleModal">
        <x-card title="Confirmação de Cancelamento">
            <p class="text-gray-600">
               Deseja mesmo cancelar o plano deste barbeiro?, caso você cancele você não terá mais acesso aos benefícios concedidos e terá que assinar novamente caso queira voltar com o contrato, tem certeza que deseja cancelar?
            </p>
     
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    @if($selectedBarbeiro)
                    <x-button red label="Cancelar" wire:click="cancelar({{ $selectedBarbeiro->id }})" />
                    @endif
                </div>
            </x-slot>
        </x-card>
    </x-modal>
      <div class="w-full max-w-full   px-3 mt-6 md:w-5/12 md:flex-none">
        <div class="relative flex flex-col  min-w-0 mb-6 break-words max-h-full bg-white border-0 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
          <div class="p-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
              <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                <h6 class="mb-0 dark:text-white">Your Transactions</h6>
              </div>
              <div class="flex items-center justify-end max-w-full px-3 dark:text-white/80 md:w-1/2 md:flex-none">
                <i class="mr-2 far fa-calendar-alt"></i>
                <small>23 - 30 March 2020</small>
              </div>
            </div>
          </div>
          <div class="flex-auto p-4 pt-6 ">
            <h6 class="mb-4 text-xs font-bold leading-tight uppercase dark:text-white text-slate-500">Newest</h6>
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 rounded-t-inherit text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-red-600 border-transparent bg-transparent text-center align-middle font-bold uppercase text-red-600 transition-all hover:opacity-75"><i class="fas fa-arrow-down text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">Netflix</h6>
                    <span class="text-xs leading-tight dark:text-white/80">27 March 2020, at 12:30 PM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="relative z-10 inline-block m-0 text-sm font-semibold leading-normal text-transparent bg-gradient-to-tl from-red-600 to-orange-600 bg-clip-text">- $ 2,500</p>
                </div>
              </li>
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-emerald-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-emerald-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">Apple</h6>
                    <span class="text-xs leading-tight dark:text-white/80">27 March 2020, at 04:30 AM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="relative z-10 inline-block m-0 text-sm font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text">+ $ 2,000</p>
                </div>
              </li>
            </ul>
            <h6 class="my-4 text-xs font-bold leading-tight uppercase dark:text-white text-slate-500">Yesterday</h6>
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 rounded-t-inherit text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-emerald-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-emerald-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">Stripe</h6>
                    <span class="text-xs leading-tight dark:text-white/80">26 March 2020, at 13:45 PM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="relative z-10 inline-block m-0 text-sm font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text">+ $ 750</p>
                </div>
              </li>
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-emerald-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-emerald-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">HubSpot</h6>
                    <span class="text-xs leading-tight dark:text-white/80">26 March 2020, at 12:30 PM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="relative z-10 inline-block m-0 text-sm font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text">+ $ 1,000</p>
                </div>
              </li>
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-emerald-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-emerald-500 transition-all hover:opacity-75"><i class="fas fa-arrow-up text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">Creative Tim</h6>
                    <span class="text-xs leading-tight dark:text-white/80">26 March 2020, at 08:30 AM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="relative z-10 items-center inline-block m-0 text-sm font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text">+ $ 2,500</p>
                </div>
              </li>
              <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                <div class="flex items-center">
                  <button class="leading-pro ease-in text-xs bg-150 w-6.5 h-6.5 p-1.2 rounded-3.5xl tracking-tight-rem bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-slate-700 border-transparent bg-transparent text-center align-middle font-bold uppercase text-slate-700 transition-all hover:opacity-75"><i class="fas fa-exclamation text-3xs"></i></button>
                  <div class="flex flex-col">
                    <h6 class="mb-1 text-sm leading-normal dark:text-white text-slate-700">Webflow</h6>
                    <span class="text-xs leading-tight dark:text-white/80">26 March 2020, at 05:00 AM</span>
                  </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                  <p class="flex items-center m-0 text-sm font-semibold leading-normal text-slate-700">Pending</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>



    @script
<script>
    Alpine.data('mercadoPagoIntegration', () => ({
     
        initMercadoPago() {
            const mp = new MercadoPago('APP_USR-6c284546-a6b3-429f-8181-2a69a2c4f764', {
                locale: 'pt-br'
            });

            const bricksBuilder = mp.bricks();

            bricksBuilder.create("cardPayment", "cardPaymentBrick_container", {
              initialization: {
                        amount: 15,
                        payer: {
                    email: @json(auth()->user()->email)
                  },
                    },
                
                    customization: {
                  
                        visual: {
                          texts: {
                            formSubmit: "Adicionar"
                    },
                            style: {
                                theme: "default"
                            }
                        },
                        paymentMethods: {
                            maxInstallments: 1
                        }
                    },
                callbacks: {
                    onReady: () => {
                        // Callback chamado quando o Brick está pronto.
                        // Aqui você pode omitir carregamentos do seu site, por exemplo.
                    },
                    onSubmit: (cardFormData) => {
                       
                     @this.save(
                        
                      cardFormData,
                       
                    
                         
                    
                     );
                    },
                    onError: (error) => {
                        // Callback chamado para todos os casos de erro relacionados ao Brick.
                        console.error(error);
                    },
                },
            });
        },
    }));
</script>
@endscript
