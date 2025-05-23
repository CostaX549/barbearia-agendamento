<div class="p-2 flex flex-row-reverse justify-between">
    @if($this->hasNextStep())
        <x-button lg primary   wire:click="goToNextStep" spinner="goToNextStep" :label="__('Next')"/>
    @else
        <x-button lg primary type="submit" spinner="submit" :label="__('Submit')" x-on:click="$dispatch('barbearia-salva')"/>
    @endif
    @if($this->hasPrevStep())
        <x-button lg dark :label="__('Back')" icon="chevron-left" wire:click="goToPrevStep" spinner="goToPrevStep"/>
    @endif
   
</div>
