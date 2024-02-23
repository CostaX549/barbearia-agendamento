<div class="flex justify-center mt-5 ">
  @use(Carbon\Carbon)

@if($this->barbearia->payment_id && $this->barbearia->payment_method->value === 'PIX' && $this->assinatura['status'] !== 'authorized')

         
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<div
  class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
  <h5
    class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
 Pagar PIX
  </h5>
  @if (isset($this->assinatura['point_of_interaction'])) 
  <img src="{{ 'data:image/jpeg;base64,' . $this->assinatura['point_of_interaction']['transaction_data']['qr_code_base64'] }}" class="w-[300px]" alt="QR Code PIX" />
 @endif
  <button
    type="button"
    class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
    data-te-ripple-init
    data-te-ripple-color="light">
    @if (isset($this->assinatura['date_of_expiration'])) 
Válido Por {{ Carbon::parse($this->assinatura['date_of_expiration'])->diffInHours(Carbon::now()) }} horas
     @endif
  </button>
</div>
@elseif($this->barbearia->payment_method->value === 'Cartão de Crédito' && $this->assinatura['status'] !== 'cancelled' || $this->barbearia->payment_method->value === 'Cartão de Débito' )

<div
  class="block rounded-lg bg-white p-6 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-neutral-700">
  <h5
  class="mb-2 mt-0 text-3xl font-medium leading-tight text-black">
Gerenciar Assinatura
  </h5>

  <h3 class="mb-2 mt-0 text-2xl font-medium leading-tight text-black">
Método de Pagamento: {{ $this->assinatura['payment_method_id'] }}

  </h3>

  <h3 class="mb-2 mt-0 text-2xl font-medium leading-tight text-black">

    Cobrança: R${{ $this->assinatura['auto_recurring']['transaction_amount'] }}
    
      </h3>

      

    <h3 class="mb-2 mt-0 text-2xl font-medium leading-tight text-black">
        Próxima Cobrança: {{ \Carbon\Carbon::parse($this->assinatura['next_payment_date'])->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY') }}
        
          </h3>
          @if($assinatura['status'] === 'authorized')
  <button
    wire:click = "cancelarAssinatura"
    type="button"
    class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
    data-te-ripple-init
    wire:loading.class="opacity-50"
    wire:loading.attr="disabled"
    data-te-ripple-color="light">
    <span wire:loading wire:target="cancelarAssinatura">
   Cancelando assinatura...
    </span>
<span wire:loading.remove wire:target="cancelarAssinatura">
Cancelar Assinatura
</span>
  </button>
  <button
    wire:click = "pausarAssinatura"
    type="button"
    class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
    data-te-ripple-init
    data-te-ripple-color="light">
  Pausar Assinatura
  </button>
  @elseif($this->assinatura['status'] === 'paused')
  <button
  wire:click = "assinarNovamente"
  type="button"
  class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
  data-te-ripple-init
  data-te-ripple-color="light">
         Assinar Novamente
</button>
@endif
   

</div>

@elseif($this->barbearia->payment_method->value === 'Boleto')

<button >{{ $this->assinatura['transaction_details']['barcode']['content']}} </button>
<a href="{{ $this->assinatura['transaction_details']['external_resource_url']}}">Pagar com Boleto</a>

@else

<div  id="paymentBrick_container" wire:ignore></div>

@assets
<script src="https://sdk.mercadopago.com/js/v2"></script>
  @endassets

@script
<script>
  const mp = new MercadoPago('APP_USR-0eacdb13-ba6e-4623-bf57-30f0edeb7a8f', {
    locale: 'pt-br'
  });
  const bricksBuilder = mp.bricks();
    const renderPaymentBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          /*
            "amout" is the total sum to be paid from all payment methods but Mercado Pago Wallet and Parcels without credit card which have their processing value determined on the backend via "preferenceId"
          */
          amount: 15,
       
          payer: {
            firstName: "",
            lastName: "",
            email: "test_user_1498281909@testuser.com",
          },
        },
        customization: {
          visual: {
            style: {
              theme: "default",
            },
          },
          paymentMethods: {
            mercadoPago: "all",
            creditCard: "all",
										debitCard: "all",
										ticket: "all",
										bankTransfer: "all",
										atm: "all",
										onboarding_credits: "all",
										wallet_purchase: "all",
                    
                    ticket: "all",
            maxInstallments: 1
          },
        },
        callbacks: {
          onReady: () => {
            /*
             Callback called when Brick is ready.
             Here, you may omit loadings from your website, for instance.
            */
          },
          onSubmit: ({ selectedPaymentMethod, formData }) => {
            @this.assinar(
              formData,
                 selectedPaymentMethod,
                 
                    );
          },
          onError: (error) => {
            // callback called to all error cases related to the Brick
            console.error(error);
          },
        },
      };
      window.paymentBrickController = await bricksBuilder.create(
        "payment",
        "paymentBrick_container",
        settings
      );
    };
    renderPaymentBrick(bricksBuilder);


  </script>
  @endscript


@endif


</div>
