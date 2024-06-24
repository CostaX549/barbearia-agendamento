<div x-data="avaliacaoData()">
    <h2 class="mb-6 text-3xl text-center font-bold">
        Comentários
    </h2>
    <div class="flex flex-wrap justify-center mb-6">
        @foreach($this->avaliacoes as $avaliacao)
        <div class="bg-white dark:bg-gray-800 text-black dark:text-gray-200 p-4 antialiased flex max-w-lg">
            <img class="rounded-full h-8 w-8 mr-2 mt-1" src="{{ $avaliacao->user->profile_photo_url }}"/>

            <div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                    <div class="font-semibold text-sm leading-relaxed">{{ $avaliacao->user->name }}</div>
                    <div class="text-normal leading-snug md:leading-normal">
                        {{ $avaliacao->comment }}
                    </div>
                </div>
                <ul class="my-1 flex list-none gap-1 p-0">
                    @for ($i = 1; $i <= 5; $i++)
                    <li>
                        <span class="text-primary [&>svg]:h-5 [&>svg]:w-5">
                            @if ($i <= $avaliacao->qtd)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            @endif
                        </span>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
        @endforeach
    </div>
    <div class=" w-[500px] m-auto px-3 mb-2 mt-6">
        <ul id="selected-value-example" class="ratingStar my-1 flex list-none gap-1 p-0">
            <template x-for="(rating, index) in ratings" :key="index">
                <li>
                    <span
                        class="text-black [&>svg]:h-5 [&>svg]:w-5"
                        :title="rating.title"
                        data-te-rating-icon-ref
                        @click="selectRating(index + 1)"
                        x-bind:class="{'text-yellow-500': index < selectedRating}"
                        @onSelect.te.rating="handleSelectRating(index + 1)">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>
        <textarea
            class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
            wire:model="comment"
            placeholder="Avaliação"
            required>
        </textarea>
    </div>
    <div class="w-full flex justify-center mb-12 px-3 my-3">
        <button
            id="botaoAvaliar"
            wire:loading.class="opacity-50"
            :data-barbearia-id="{{ $barbearia->id }}"
            @click="submitAvaliacao"
            class="inline-block rounded-lg w-[450px] bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
            Avalie a Barbearia
        </button>
    </div>
</div>
@script
<script>

        Alpine.data('avaliacaoData', () => ({
            ratings: [
                { title: 'Bad' },
                { title: 'Poor' },
                { title: 'Okay' },
                { title: 'Good' },
                { title: 'Excellent' }
            ],
            selectedRating: 0,

            selectRating(value) {
                this.selectedRating = value;
                // Trigger custom event
                this.$dispatch('onSelect.te.rating', { value: this.selectedRating });
            },
            handleSelectRating(value) {
                this.selectedRating = value;
            },
            submitAvaliacao() {
                let barbeariaId = document.getElementById('botaoAvaliar').getAttribute('data-barbearia-id');
                console.log('Barbearia ID:', barbeariaId);
                Livewire.dispatch('avaliar', {
                    valor: this.selectedRating,
                    id: barbeariaId,

                });
            }
        }));

</script>
@endscript
