<div>
    @if($barbeiro->payment_method->value === 'Cartão de Crédito' || $barbeiro->payment_method->value === 'Cartão de Débito')
    <h1 class="mb-2">Atual método de pagamento: {{  $barbeiro->payment_method->value}}</h1>
     <p>Caso você adicione um novo cartão ou utilize um cartão novo recém-adicionado, será automaticamente alterado no plano atual.</p>
    @else
    <h1 class="mb-2">Atual método de pagamento: {{  $barbeiro->payment_method->value}}</h1>

    @endif

    <div id="paymentBrick_container" wire:ignore x-data="editarContrato" x-init="editarContrato()">




</div>
@assets
<script src="https://sdk.mercadopago.com/js/v2"></script>
@endassets
@script
<script>

    Alpine.data('editarContrato', () => ({
        selectedPlan: '',
        editarContrato() {
            const mp = new MercadoPago('TEST-ccf01c62-f583-48b5-ab9a-6ce59349afc3', {
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
                        email: @json(auth()->user()->email),
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

                     @this.editarAssinatura(

                      formData,
                         selectedPaymentMethod,



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
