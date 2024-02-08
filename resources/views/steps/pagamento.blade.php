<div>
  
{{--     
    <form id="form-checkout" class="flex flex-col gap-2"  wire:ignore>
        <div id="form-checkout__cardNumber" ></div>
        <div id="form-checkout__expirationDate" ></div>
        <div id="form-checkout__securityCode" ></div>
        <input type="text" id="form-checkout__cardholderName" class="border border-gray-300 rounded-md p-2 mt-2" placeholder="Titular do cartão" />
        <select id="form-checkout__issuer" class="border border-gray-300 rounded-md p-2 mt-2"></select>
        <select id="form-checkout__installments" class="border border-gray-300 rounded-md p-2 mt-2"></select>
        <select id="form-checkout__identificationType" class="border border-gray-300 rounded-md p-2 mt-2"></select>
        <input type="text" id="form-checkout__identificationNumber" class="border border-gray-300 rounded-md p-2 mt-2" placeholder="Número do documento" />
        <input type="email" id="form-checkout__cardholderEmail" class="border border-gray-300 rounded-md p-2 mt-2" placeholder="E-mail" />
    
        <button  type="submit" id="form-checkout__submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Pagar</button>
        <progress value="0" class="progress-bar mt-2">Carregando...</progress>

    </form>
   


    @script
    <script>
             document.addEventListener('livewire:initialized', function() {
        const mp = new MercadoPago("TEST-56d633ef-081b-4f8e-9c91-81dcc53e0611");
    
        const cardForm = mp.cardForm({
            amount: "100.5",
            iframe: true,
            form: {
                id: "form-checkout",
                cardNumber: {
                    id: "form-checkout__cardNumber",
                    placeholder: "Número do cartão",
                },
                expirationDate: {
                    id: "form-checkout__expirationDate",
                    placeholder: "MM/YY",
                },
                securityCode: {
                    id: "form-checkout__securityCode",
                    placeholder: "Código de segurança",
                },
                cardholderName: {
                    id: "form-checkout__cardholderName",
                    placeholder: "Titular do cartão",
                },
                issuer: {
                    id: "form-checkout__issuer",
                    placeholder: "Banco emissor",
                },
                installments: {
                    id: "form-checkout__installments",
                    placeholder: "Parcelas",
                },        
                identificationType: {
                    id: "form-checkout__identificationType",
                    placeholder: "Tipo de documento",
                },
                identificationNumber: {
                    id: "form-checkout__identificationNumber",
                    placeholder: "Número do documento",
                },
                cardholderEmail: {
                    id: "form-checkout__cardholderEmail",
                    placeholder: "E-mail",
                },
            },
            callbacks: {
                onFormMounted: error => {
                    if (error) return console.warn("Form Mounted handling error: ", error);
                    console.log("Form mounted");
                },

                onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();


          @this.pagar(
                        token,
                        issuer_id,
                        payment_method_id,
                        Number(amount),
                        Number(installments),
                        "Barbearia",
                        email,
                        identificationType,
                        identificationNumber
                    );

          
        },
           
                onFetching: (resource) => {
                    console.log("Fetching resource: ", resource);
    
                    // Animate progress bar
                    const progressBar = document.querySelector(".progress-bar");
                    progressBar.removeAttribute("value");
    
                    return () => {
                        progressBar.setAttribute("value", "0");
                    };
                }
            },
        });


     
    });


    </script>
    @endscript
 --}}
 {{-- <div id="cardPaymentBrick_container" wire:ignore></div>

 @assets 
<script src="https://sdk.mercadopago.com/js/v2"></script>
@endassets
@script 
<script>
    const mp = new MercadoPago('APP_USR-0eacdb13-ba6e-4623-bf57-30f0edeb7a8f', {
      locale: 'pt-BR'
    });
    const bricksBuilder = mp.bricks();
    const renderCardPaymentBrick = async (bricksBuilder) => {
      const settings = {
        initialization: {
          amount: 15, // valor total a ser pago
          payer: {
            email: "test_user_1498281909@testuser.com",
          },
        },
        customization: {
          visual: {
            style: {
              customVariables: {
                theme: 'default', // | 'dark' | 'bootstrap' | 'flat'
              }
            }
          },
            paymentMethods: {
            
              maxInstallments: 1,
            }
        },
        callbacks: {
          onReady: () => {
            // callback chamado quando o Brick estiver pronto
          },
          onSubmit: (CardData, additionalData) => {
      

          @this.save(
                 CardData,
                 additionalData
                    );
          },
          onError: (error) => {
           console.log(error);
          },
        },
      };
      window.cardPaymentBrickController = await bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', settings);
    };
    renderCardPaymentBrick(bricksBuilder);
  </script>
@endscript --}}
@assets
<script src="https://sdk.mercadopago.com/js/v2"></script>
  @endassets


 
<div id="paymentBrick_container" wire:ignore></div>

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
            @this.save(
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


</div>