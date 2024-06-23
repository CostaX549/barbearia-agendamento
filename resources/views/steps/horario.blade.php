


    <div class=" flex flex-col gap-4 px-2" >
        @foreach(['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'] as $index => $dia)
          
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
                label="Horário Inicial"
             
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
           
        @endforeach
    </div>

