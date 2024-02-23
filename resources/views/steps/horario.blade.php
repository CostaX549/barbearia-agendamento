

<div>
    <div>
        @foreach(['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] as $index => $dia)
            <div class="flex flex-wrap items-center gap-4" >
                <x-checkbox id="{{ strtolower($dia) }}" md value="{{ $index }}" wire:model.blur="state.dias.{{$index }}" label="{{ $dia }}" />

                <x-time-picker
                    id="{{ strtolower($dia) }}-inicial"
                    wire:model="state.horariosIniciais.{{ $index }}"
                    label="Horário Inicial"
               
                    placeholder="22:30"
                    format="24"
                    class="mb-3"
                />

                <x-time-picker
                    id="{{ strtolower($dia) }}-final"
                    wire:model="state.horariosFinais.{{ $index }}"
                    label="Horário Final"
                 
                    placeholder="22:30"
                    format="24"
                    class="mb-3"
                />
          <h2 class="font-bold">Intervalo: </h2>
                <x-time-picker
                id="{{ strtolower($dia) }}-final"
                wire:model="state.intervaloInicial.{{ $index }}"
                label="Horário Final"
             
                placeholder="22:30"
                format="24"
                class="mb-3"
            />

            <x-time-picker
            id="{{ strtolower($dia) }}-final"
            wire:model="state.intervaloFinal.{{ $index }}"
            label="Horário Final"
         
            placeholder="22:30"
            format="24"
            class="mb-3"
        />
            </div>
        @endforeach
    </div>
</div>
