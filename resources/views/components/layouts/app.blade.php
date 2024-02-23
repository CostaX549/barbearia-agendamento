<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>



    @livewireStyles
    @wireUiScripts
     @vite(['resources/css/app.css', 'resources/js/app.js']) 


 
{{-- <header>
  <!-- Navbar -->
 <div class="w-full bg-white p-3">
  <div class="flex justify-center">
    <a
    data-te-offcanvas-toggle
    href="#offcanvasExample"
    role="button"
    aria-controls="offcanvasExample"
    data-te-ripple-init
    data-te-ripple-color="light">
  <img src="/barbershop.avif"  class="w-[100px]"alt="">
</a>
</div>
 </div>
  <!-- Navbar -->
  <div
  class="invisible fixed bottom-0 left-0 top-0 z-[1045] flex w-96 max-w-full -translate-x-full flex-col border-none bg-white bg-clip-padding text-neutral-700 shadow-sm outline-none transition duration-300 ease-in-out [&[data-te-offcanvas-show]]:transform-none"
  tabindex="-1"
  id="offcanvasExample"
  aria-labelledby="offcanvasExampleLabel"
  data-te-offcanvas-init>
  <div class="flex items-center justify-between p-4">
    <h5
      class="mb-0 font-semibold leading-normal"
      id="offcanvasExampleLabel">
      Offcanvas
    </h5>
    <button
      type="button"
      class="box-content rounded-none border-none opacity-50 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
      data-te-offcanvas-dismiss>
      <span
        class="w-[1em] focus:opacity-100 disabled:pointer-events-none disabled:select-none disabled:opacity-25 [&.disabled]:pointer-events-none [&.disabled]:select-none [&.disabled]:opacity-25">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-6 w-6">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12" />
        </svg>
      </span>
    </button>
  </div>
  <div class="flex-grow overflow-y-auto p-4">
    <div>
      Some text as placeholder. In real life you can have the elements
      you have chosen. Like, text, images, lists, etc.
    </div>
     <form action="/logout" method="post">
                @csrf
                <button type="submit">Sair</button>
     </form>
    <div class="relative mt-4" data-te-dropdown-ref>
    
      <button
        class="flex items-center whitespace-nowrap rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none"
        type="button"
        id="dropdownMenuButton"
        data-te-dropdown-toggle-ref
        data-te-ripple-init
        data-te-ripple-color="light">
        Dropdown button
        <span class="ml-2 w-2">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="caret-down"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 320 512">
            <path
              fill="currentColor"
              d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path>
          </svg>
        </span>
      </button>
      <ul
        class="absolute z-[1000] float-left m-0 hidden min-w-max list-none rounded-lg border-none bg-white bg-clip-padding py-2 text-left text-base shadow-lg [&[data-te-dropdown-show]]:block"
        aria-labelledby="dropdownMenuButton"
        data-te-dropdown-menu-ref>
        <li>
          <a
            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400"
            href="#"
            data-te-dropdown-item-ref
            >Action
          </a>
        </li>
        <li>
          <a
            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400"
            href="#"
            data-te-dropdown-item-ref
            >Another action
          </a>
        </li>
        <li>
          <a
            class="block w-full whitespace-nowrap bg-transparent px-4 py-2 text-sm font-normal text-neutral-700 hover:bg-neutral-100 active:text-neutral-800 active:no-underline disabled:pointer-events-none disabled:bg-transparent disabled:text-neutral-400"
            href="#"
            data-te-dropdown-item-ref
            >Something else here
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>
  <!-- Jumbotron -->

 
</header> --}}
    <body>
        
        {{ $slot }}


        
        @livewireScriptConfig 
     
<script src="https://www.paypal.com/sdk/js?client-id=AeWnrfIe0iqFrKZxVGGhbn9l9SwdgUAO90LJB-bP8i3ubeHdC7LzH2b7zjHeHSxODvp775m_-1cztzVQ&currency=BRL"></script>
 
    

      


    </body>
</html>
