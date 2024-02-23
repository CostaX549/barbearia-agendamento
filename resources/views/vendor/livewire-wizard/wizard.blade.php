<div>
 {{--    <form wire:submit="save"> --}}
        @include('livewire-wizard::steps-header')
        <div class="w-[100%] mt-2 mb-2">
            <x-errors class="mb-4"/>
            {{ $this->getCurrentStep() }}
        </div>

        @include('livewire-wizard::steps-footer')
  {{--   </form> --}}
</div>
