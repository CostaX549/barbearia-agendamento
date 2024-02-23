




 

  <div id="paymentBrick_container" wire:ignore x-data="mercadoPagoIntegration" x-init="initMercadoPago()">
    <input type="radio" name="plan" id="monthly" value="mensal" @change="selectedPlan = $event.target.value">
    <label for="mensal">Plano Mensal</label><br>
    
    <input type="radio" name="plan" id="annual" value="anual" @change="selectedPlan = $event.target.value">
    <label for="anual">Plano Anual</label><br>
    
    <input type="radio" name="plan" id="semiannual" value="semestral" @change="selectedPlan = $event.target.value">
    <label for="semestral">Plano Semestral</label><br>
</div>


@assets
<script src="https://sdk.mercadopago.com/js/v2"></script>
  @endassets
  
@script
<script>
    Alpine.data('mercadoPagoIntegration', () => ({
        selectedPlan: '',
        initMercadoPago() {
            const mp = new MercadoPago('APP_USR-f1004ea5-890e-45cc-b3b2-f42af7c5bff0', {
                locale: 'pt-br'
            });

            const bricksBuilder = mp.bricks();

            bricksBuilder.create("payment", "paymentBrick_container", {
                initialization: {
                    amount: 15,
/*   preferenceId: "1642165427-578edade-19d7-4033-a68d-52846af975ab", */
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
                     
                        creditCard: "all",
                        debitCard: "all",
                        ticket: "all",
                        bankTransfer: "all",
                        atm: "all",
             /*      mercadoPago: "all", */
             
                        maxInstallments: 1
                    },
                },
                callbacks: {
                    onReady: () => {
                        // Callback chamado quando o Brick está pronto.
                        // Aqui você pode omitir carregamentos do seu site, por exemplo.
                    },
                    onSubmit: ({ selectedPaymentMethod, formData }) => {
                       
                     @this.save(
                        
                      formData,
                         selectedPaymentMethod,
                        this.selectedPlan
                         
                    
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
 {{--  <div id="paymentBrick_container" x-data="{ initialized: false }" ></div>

<script>
    // Função para inicializar o MercadoPago e renderizar o tijolo de pagamento
    async function initMercadoPago() {
        const mp = new MercadoPago('APP_USR-0eacdb13-ba6e-4623-bf57-30f0edeb7a8f', {
            locale: 'pt-br'
        });
        const bricksBuilder = mp.bricks();
        
        try {
            const settings = {
                initialization: {
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
                        // Callback called when Brick is ready.
                        // Here, you may omit loadings from your website, for instance.
                    },
                    onSubmit: ({ selectedPaymentMethod, formData }) => {
                        // Callback called when the user submits the form
                        // You may want to handle form submission here
                        // Example: @this.save(formData, selectedPaymentMethod);
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

            // Defina o valor de initialized como true para indicar que o MercadoPago foi inicializado
            document.getElementById("paymentBrick_container").dataset.initialized = true;
        } catch (error) {
            console.error("Error rendering payment brick:", error);
        }
    }

    // Chame a função initMercadoPago se o elemento paymentBrick_container ainda não foi inicializado
   
        const initialized = document.getElementById("paymentBrick_container").dataset.initialized;
        if (!initialized) {
            initMercadoPago();
        }
        document.getElementById("paymentBrick_container").addEventListener("", function() {
          location.reload();
    });
    
</script>
 --}}
