<div class="flex flex-col gap-6 p-5">
    @foreach($this->datas as $data)
        @php
        \Carbon\Carbon::setLocale('pt-BR');
            $startDateTime = \Carbon\Carbon::parse($data->start_date);
            $endDateTime = \Carbon\Carbon::parse($data->end_date);
            $formattedStartDateTime = $startDateTime->isoFormat('dddd, D [de] MMMM [às] HH:mm');
            $formattedEndDateTime = $endDateTime->isoFormat('dddd, D [de] MMMM [às] HH:mm');
        @endphp

        <x-card title="{{ $formattedStartDateTime }} - {{ $formattedEndDateTime }}">
            Objetivo: {{ ucfirst($data->status) }} dia de Trabalho.
     
            <x-slot name="footer">
                <div class="flex justify-between items-center">
                    @if($data->status === 'adicionar')
                    <x-button wire:click="delete({{ $data->id }})" label="Remover Horário de Trabalho" flat negative />
                    @else 
                    <x-button wire:click="delete({{ $data->id }})" label="Liberar Horário de Trabalho" flat negative />
                    @endif

                    <x-button label="Save" primary />
                </div>
            </x-slot>
        </x-card>
    @endforeach
</div>