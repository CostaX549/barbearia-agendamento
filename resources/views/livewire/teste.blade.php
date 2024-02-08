
@use('App\Models\Plan')
<div >
<!-- Navbar -->
{{--     <div
      class="w-full text-gray-700 bg-white h-16 fixed top-0 animated z-40"
      x-bind:class='{ "bg-black shadow-lg": !atTop }'
    >
      <div
        x-data="{ open: false }"
        class="flex flex-col max-w-screen-xl px-2 mx-auto md:items-center md:justify-between md:flex-row"
      >
        <div class="p-4 flex flex-row items-center justify-between gap-5">
          <a
          data-te-offcanvas-toggle
          href="#offcanvasExample"
          role="button"
          aria-controls="offcanvasExample"
          data-te-ripple-init
          data-te-ripple-color="light">
        <img src="/barbershop.avif"  class="w-[100px]"alt="">
      </a>
          <ul
          class="flex gap-2"
          role="tablist"
          id="myTab"
          data-te-nav-ref>
          <li role="presentation" class="flex-auto text-center"
               wire:ignore.self
          >
            <a
              wire:ignore.self
              href="#tabs-home01"
              class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
              data-te-toggle="pill"
              data-te-target="#tabs-home01"
              data-te-nav-active
              role="tab"
              aria-controls="tabs-home01"
              aria-selected="true"
              >Barbearias</a
            >
          </li>
          <li wire:ignore.self role="presentation" class="flex-auto text-center">
            <a
             wire:ignore.self
              href="#tabs-profile01"
              class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
              data-te-toggle="pill"
              data-te-target="#tabs-profile01"
              role="tab"
              aria-controls="tabs-profile01"
              aria-selected="false"
              >Crie sua barbearia</a
            >
          </li>
          <li  class="flex-auto text-center">
            <a
           
              href="/meus-agendamentos"
              wire:navigate
              class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
              
              
            
             
              
              >Agenda</a
            >
          </li>
         
        
        
        
        
           @if(auth()->user()->barbearias->count()>0)
           <li wire:ignore.self role="presentation" class="flex-auto text-center">
            <a
              wire:ignore.self
              href="#tabs-messages01"
              class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
              data-te-toggle="pill"
              data-te-target="#tabs-messages01"
              role="tab"
              aria-controls="tabs-messages01"
              aria-selected="false"
              >Suas Barbearias</a
            >
          </li>    
           @endif
          

          
          <!-- Button Mobile Nav -->
          <button
            class="md:hidden rounded-lg focus:outline-none focus:shadow-outline"
            @click="open = !open"
          >
            <span class="text-lg text-primary"
              ><i class="fas fa-bell"></i
            ></span>
          </button>
          <!-- End Button Mobile Nav -->
        </div>
        <!-- Navbar Mobile -->
        <nav
          :class="{'flex': open, 'hidden': !open}"
          class="flex-col flex-grow pb-4 hidden bg-white shadow-lg rounded-b"
        >
          <a
            class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            href="#"
            >Notifikasi 1</a
          >
          <a
          class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
          href="#"
          >Notifikasi 1</a
        >
        <a
        class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
        href="#"
        >Notifikasi 1</a
      >
      <a
      class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
      href="#"
      >Notifikasi 1</a
    >
        </nav>
        <!-- End Navbar Mobile -->
        <nav
          class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row bg-white"
        >

        
          <a
            class="flex items-center px-3 py-1 mt-2 text-lg font-semibold text-primary rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            href="#"
          >
            <i class="fas fa-envelope"></i>
          </a>

          
          <div
            @click.away="open = false"
            class="relative"
            x-data="{ open: false }"
          >
            <button
              @click="open = !open"
              class="flex flex-row items-center w-full px-3 py-1 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:mt-0 md:ml-2 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            >
              <span class="text-lg text-primary"
                ><i class="fas fa-bell"></i
              ></span>
            </button>
            <div
              x-show="open"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="transform opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95"
              class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48"
            >
              <div class="px-2 py-2 bg-white rounded-md shadow">
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Notifikasi 1</a
                >
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Notifikasi #2</a
                >
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Notifikasi #3</a
                >
              </div>
            </div>
          </div>
          <div
            @click.away="open = false"
            class="relative"
            x-data="{ open: false }"
          >
            <button
              @click="open = !open"
              class="flex flex-row items-center w-full px-1 py-1 mt-2 text-sm font-semibold text-left bg-transparent rounded-full md:w-auto md:mt-0 md:ml-2 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
            >
              <img src="https://randomuser.me/api/portraits/men/12.jpg" class="w-auto h-6 rounded-full" alt="" />
            </button>
            <div
              x-show="open"
              x-transition:enter="transition ease-out duration-100"
              x-transition:enter-start="transform opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95"
              class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48"
            >
              <div class="px-2 py-2 bg-white rounded-md shadow">
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Forum</a
                >
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Chat</a
                >
                <a
                  class="block px-4 py-2 mt-2  bg-transparent rounded-lg  text-sm font-semibold md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                  href="#"
                  >Link #3</a
                >
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div> --}}
    <!-- End Navbar -->

    <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<!-- Main navigation container -->
<nav
class="sticky top-0 flex w-full z-10 flex-nowrap items-center justify-between bg-[#FBFBFB] py-2 text-neutral-500 shadow-lg hover:text-neutral-700 focus:text-neutral-700 dark:bg-neutral-600 lg:flex-wrap lg:justify-start lg:py-4"
data-te-navbar-ref>
<div class="flex w-full flex-wrap items-center justify-between px-3">
  <div class="ml-2">
    <a
    data-te-offcanvas-toggle
    href="#offcanvasExample"
    role="button"
    aria-controls="offcanvasExample"
    data-te-ripple-init
    data-te-ripple-color="light">
  <x-icon lg name="scissors" class="w-[50px] h-[50px]" />
</a>
  </div>
  <!-- Hamburger button for mobile view -->
  <button
    class="block border-0 bg-transparent px-2 text-neutral-500 hover:no-underline hover:shadow-none focus:no-underline focus:shadow-none focus:outline-none focus:ring-0 dark:text-neutral-200 lg:hidden"
    type="button"
    data-te-collapse-init
    data-te-target="#navbarSupportedContent2"
    aria-controls="navbarSupportedContent2"
    aria-expanded="false"
    aria-label="Toggle navigation">
    <!-- Hamburger icon -->
    <span class="[&>svg]:w-7">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24"
        fill="currentColor"
        class="h-7 w-7">
        <path
          fill-rule="evenodd"
          d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
          clip-rule="evenodd" />
      </svg>
    </span>
  </button>

  <!-- Collapsible navbar container -->
  <div
    class="!visible mt-2 hidden flex-grow basis-[100%] items-center lg:mt-0 lg:!flex lg:basis-auto"
    id="navbarSupportedContent2"
    data-te-collapse-item>
    <!-- Left links -->
    <ul
    id="myTab"
    class="ml-5 flex list-none flex-col flex-wrap pl-0 md:flex-row"
    role="tablist"
    data-te-nav-ref>
    <li role="presentation">
      <a
        href="#pills-home7"
        class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-neutral-800 data-[te-nav-active]:text-neutral-50 dark:bg-neutral-700 dark:text-white dark:data-[te-nav-active]:!bg-neutral-900 dark:data-[te-nav-active]:text-neutral-50 md:mr-4"
        id="pills-home-tab7"
        data-te-toggle="pill"
        data-te-target="#pills-home7"
        data-te-nav-active
        role="tab"
        aria-controls="pills-home7"
        aria-selected="true"
        wire:ignore.self
        >Barbearias</a
      >
    </li>
    <li role="presentation">
      <a
        href="#pills-profile7"
        class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-neutral-800 data-[te-nav-active]:text-neutral-50 dark:bg-neutral-700 dark:text-white dark:data-[te-nav-active]:!bg-neutral-900 dark:data-[te-nav-active]:text-neutral-50 md:mr-4"
        id="pills-profile-tab7"
        data-te-toggle="pill"
        data-te-target="#pills-profile7"
        role="tab"
        aria-controls="pills-profile7"
        aria-selected="false"
        wire:ignore.self
        >Crie sua barbearia</a
      >
    </li>
  
    <li role="presentation">
      <a
        href="#pills-contact7"
        class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-neutral-800 data-[te-nav-active]:text-neutral-50 dark:bg-neutral-700 dark:text-white dark:data-[te-nav-active]:!bg-neutral-900 dark:data-[te-nav-active]:text-neutral-50 md:mr-4"
        id="pills-contact-tab7"
        data-te-toggle="pill"
        data-te-target="#pills-contact7"
        role="tab"
        aria-controls="pills-contact7"
        aria-selected="false"
        wire:ignore.self
        >Suas Barbearias</a
      >
    </li>

    <li role="presentation">
      <a
        href="#pills-contact8"
        class="my-2 block rounded bg-neutral-100 px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 data-[te-nav-active]:!bg-neutral-800 data-[te-nav-active]:text-neutral-50 dark:bg-neutral-700 dark:text-white dark:data-[te-nav-active]:!bg-neutral-900 dark:data-[te-nav-active]:text-neutral-50 md:mr-4"
        id="pills-contact-tab8"
        data-te-toggle="pill"
        data-te-target="#pills-contact8"
        role="tab"
        aria-controls="pills-contact8"
        aria-selected="false"
        wire:ignore.self
        >Agenda</a
      >
    </li>

  </ul>

  </div>

  <div class="relative"  data-te-dropdown-position="dropstart">
    <button
      class="flex items-center whitespace-nowrap rounded bg-black px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-zinc-950 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-zinc-950 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] motion-reduce:transition-none dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]"
     @if($contagem > 0)
      wire:click="contar"
      @endif
      type="button"
      wire:ignore.self
      id="dropdownMenuButton2"
      data-te-dropdown-toggle-ref
      aria-expanded="false"
      data-te-ripple-init
      data-te-ripple-color="light">
       Notificações
      <span class="ml-2 w-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          class="h-5 w-5">
          <path
            fill-rule="evenodd"
            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
            clip-rule="evenodd" />
        </svg>
      </span>
      @if($contagem > 0)
      <span class="notification-dot">{{ $contagem }}</span>
      @endif
    </button>
    <ul
    wire:ignore.self
      class="absolute z-[1000] right-0 float-right m-0 hidden min-w-max list-none overflow-hidden rounded-lg border-none bg-white bg-clip-padding text-left text-base shadow-lg dark:bg-neutral-700 [&[data-te-dropdown-show]]:block"
      aria-labelledby="dropdownMenuButton2"
      data-te-dropdown-menu-ref>

      @forelse($this->notifications as $b)
      @if($b)
      <li>
      
        <img
    class="rounded-t-lg  object-cover "
    src="{{ asset('storage/' . $b->imagem) }}"
   style="width: 150px; height: 150px;"
    alt="" />

      <p class="p-2"> {{$b->nome}}</p>
        
       
        <ul
        id="selected-value-example"
        
        class="my-1 flex list-none gap-1 p-0"
        data-te-rating-init>
        <li>
          <span
            class="text-primary [&>svg]:h-5 [&>svg]:w-5"
            data-te-rating-icon-ref>
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
        <li>
          <span
            class="text-primary [&>svg]:h-5 [&>svg]:w-5"
            data-te-rating-icon-ref>
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
        <li>
          <span
            class="text-primary [&>svg]:h-5 [&>svg]:w-5"
            data-te-rating-icon-ref>
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
        <li>
          <span
            class="text-primary [&>svg]:h-5 [&>svg]:w-5"
            data-te-rating-icon-ref>
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
        <li>
          <span
            class="text-primary [&>svg]:h-5 [&>svg]:w-5"
            data-te-rating-icon-ref>
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
      </ul>
    
      <button
      id="botaoAvaliar"
      data-barbearia-id="{{$b->id}}"
      type="button"
      class="inline-block  w-full bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]">
      Avaliar
    </button>
     
      </li>
      @endif
      @empty 
     

    @endforelse


   @forelse($this->notificationsNearEvents as $agendamento)
    <div class="relative flex flex-col mt-6 text-gray-700 bg-white shadow-md bg-clip-border rounded-xl max-w-30" >
      <div class="p-6">
     
    
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"   class="w-12 h-12 mb-4 text-gray-900">
          <path stroke-linecap="round" stroke-linejoin="round" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
        </svg>
        
        <h5 class="block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
         {{ $agendamento->barbeiro->name }}
        </h5>
        <p class="block font-sans text-base antialiased font-semibold leading-relaxed text-inherit">
          Cortes: @foreach($agendamento->cortes as $corte)  {{ $corte->nome }}      @endforeach
        </p>
        
        <p class="block font-sans text-base antialiased font-semibold leading-relaxed text-inherit">
          @php
          $diasDaSemana = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
          $diaSemana = $diasDaSemana[date('w', strtotime($agendamento->start_date))];
          @endphp
          
          Dia: {{ \Carbon\Carbon::parse($agendamento->start_date)->format('d/m/Y H:i') }} - {{ $diaSemana }}
        </p>
       
      </div>
      <div class="p-6 pl-2 pt-0">
       
          <button
         id="agendarButton"
            class="flex items-center gap-2 px-4 py-2 font-sans text-xs font-bold text-center text-gray-900 uppercase align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
            type="button">
         Ver agenda
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
            </svg>
          </button>
   
      </div>
    </div> 
   @empty
       

    @endforelse 
    </ul>

  
  </div>


   <form action="/logout" method="post">
      @csrf
      <button type="submit">Sair</button>
</form>  



    <!-- Add any additional content or links as needed -->

</div>


</nav>
<!--Tabs navigation-->

{{-- <ul
  class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0"
  role="tablist"
  id="myTab"
  data-te-nav-ref>
  <li role="presentation" class="flex-auto text-center"
       wire:ignore.self
  >
    <a
      wire:ignore.self
      href="#tabs-home01"
      class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-home01"
      data-te-nav-active
      role="tab"
      aria-controls="tabs-home01"
      aria-selected="true"
      >Barbearias</a
    >
  </li>
  <li wire:ignore.self role="presentation" class="flex-auto text-center">
    <a
     wire:ignore.self
      href="#tabs-profile01"
      class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-profile01"
      role="tab"
      aria-controls="tabs-profile01"
      aria-selected="false"
      >Crie sua barbearia</a
    >
  </li>
  <li  class="flex-auto text-center">
    <a
   
      href="/meus-agendamentos"
      wire:navigate
      class="my-2  block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      
      
    
     
      
      >Agenda</a
    >
  </li>
 




   @if(auth()->user()->barbearias->count()>0)
   <li wire:ignore.self role="presentation" class="flex-auto text-center">
    <a
      wire:ignore.self
      href="#tabs-messages01"
      class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-black data-[te-nav-active]:text-black"
      data-te-toggle="pill"
      data-te-target="#tabs-messages01"
      role="tab"
      aria-controls="tabs-messages01"
      aria-selected="false"
      >Suas Barbearias</a
    >
  </li>    
   @endif
  
</ul> --}}

<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 


<!--Tabs content-->
<div class="mb-6">
  <div
    class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="pills-home7"
    role="tabpanel"
    aria-labelledby="pills-home-tab7"
    data-te-tab-active
    wire:ignore.self
    >
 {{--   <div class="mb-3 ml-auto mr-3 mt-10">
      <div class="relative mb-4 flex w-full flex-wrap justify-end  items-stretch">
        <input
          type="search"
          class="relative m-0 -mr-0.5 block min-w-0  rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
          placeholder="Buscar"
          wire:model.live="search"
          aria-label="Search"
          aria-describedby="button-addon1" />
    
        <!--Search button-->
        <button
          class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
          type="button"
          id="button-addon1"
          data-te-ripple-init
          data-te-ripple-color="light">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor"
            class="h-5 w-5">
            <path
              fill-rule="evenodd"
              d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </div>
    </div>
<div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">



@foreach($this->barbeariasordenadas as $barbearia)

<div
class="mx-auto mb-8 sm:mb-0  block rounded-lg max-w-[450px] bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
<div
  class="  relative   overflow-hidden bg-cover bg-no-repeat"
  data-te-ripple-init
  data-te-ripple-color="light">
  <img
    class="rounded-t-lg  object-cover "
    src="{{ asset('storage/' . $barbearia->imagem) }}"
   style="width: 450px; height: 317px;"
    alt="" />
  <a href="/{{$barbearia->slug}}"
    wire:navigate
    >
    <div
      class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
  </a>
</div>
<div class="p-6">
  <h5
    class="mb-2 text-xl font-medium leading-tight text-neutral-800">
  {{ $barbearia->nome }}
  </h5>
  <p class="mb-2 text-base text-neutral-600">
   Cep:   {{ $barbearia->cep }}
 
  
  </p>
  <p class="mb-2 text-base text-neutral-600">
   
    Rua:   {{ $barbearia->rua }}
   </p>
   <p class="mb-2 text-base text-neutral-600">
   
    Cidade:   {{ $barbearia->cidade }}
   </p>

   <p class="mb-4 text-base text-neutral-600">
   
    Estado:   {{ $barbearia->estado }}
   </p>
   <div class="flex  items-center ">
  <a
  type="button"
  data-te-ripple-init
  data-te-ripple-color="light"
  href="/{{$barbearia->slug}}"
  wire:navigate
  class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
 Conhecer Agora
</a>
<x-icon name="share" class=" w-6 h-6 ml-auto cursor-pointer"   data-te-toggle="modal"
data-te-target="#exampleModal"
 x-on:click="$wire.compartilhar({{ $barbearia->id }})"/>



</div>
</div>
</div>
@endforeach
</div>
  </div>
  <!-- Modal -->
<div
data-te-modal-init
class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
id="exampleModal"
tabindex="-1"
wire:ignore.self
aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div
  data-te-modal-dialog-ref
  wire:ignore.self
  class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px]">
  

  <div
    class="min-[576px]:shadow-[0_0.5rem_1rem_rgba(#000, 0.15)] pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-neutral-600">
    
    
    <div
      class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
      <!--Modal title-->
      <h5
        class="text-xl font-medium leading-normal text-neutral-800 dark:text-neutral-200"
        id="exampleModalLabel">
       Compartilhar
      </h5>
      <!--Close button-->
      <button
        type="button"
        class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
        data-te-modal-dismiss
        aria-label="Close">
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
      </button>

      
    </div>
<!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 

    <!--Modal body-->
    <div class="flex flex-col gap-4 items-center justify-center pt-10 pb-10" data-te-modal-body-ref>
      <div class="flex items-center space-x-4">

        <div
  class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
  role="status" wire:loading wire:target="compartilhar">

</div>  

      @if($selectedBarbearia)
      <div wire:loading.remove wire:target="compartilhar" class="flex gap-4">    
<a
type="button"
data-te-ripple-init
data-te-ripple-color="light"
class="mb-2 inline-block rounded px-6 py-5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"

href="https://www.facebook.com/sharer/sharer.php?u=http://localhost/{{ $selectedBarbearia->slug }}&quote=Conheça%20a%20barbearia:%20{{ urlencode($selectedBarbearia->nome) }}""
style="background-color: #1877f2">
<svg
  xmlns="http://www.w3.org/2000/svg"
  class="h-4 w-4"
  fill="currentColor"
  viewBox="0 0 24 24">
  <path
    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
</svg>
</a>

<!-- Instagram -->
<button
type="button"
data-te-ripple-init
data-te-ripple-color="light"
class="mb-2 inline-block rounded px-6 py-5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
style="background-color: #c13584">
<svg
  xmlns="http://www.w3.org/2000/svg"
  class="h-4 w-4"
  fill="currentColor"
  viewBox="0 0 24 24">
  <path
    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
</svg>
</button>

<!-- Google -->
<a


    href="https://twitter.com/intent/tweet?url=http://localhost/{{ $selectedBarbearia->slug }}&text=Conheça a  barbearia: {{ $selectedBarbearia->nome }}"

  target="_blank"
data-te-ripple-init
data-te-ripple-color="light"
class="mb-2 inline-block rounded px-6 py-5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg cursor-pointer"
style="background-color: black">
<i class="fa-brands fa-x-twitter fa-lg"></i>
</a>

<a

data-te-ripple-init
target="_blank"
data-te-ripple-color="light"
href="https://wa.me/?text=Confira%20esta%20barbearia: http://localhost/{{ $selectedBarbearia->slug }}&app_absent=0"
class="mb-2 inline-block rounded px-6 py-5 text-xs font-medium uppercase leading-normal text-white shadow-md transition duration-150 ease-in-out hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg"
style="background-color: #128c7e">
<svg
xmlns="http://www.w3.org/2000/svg"
class="h-4 w-4"
fill="currentColor"
viewBox="0 0 24 24">
<path
  d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
</svg>
</a>


</div> 



@endif

      </div>
      <div
  id="container-example"
  class="fixed right-0 top-0 z-[2000] mr-3 mt-[59px] hidden w-1/4 items-center rounded-lg bg-primary-100 px-6 py-4 text-base text-primary-800 data-[te-alert-show]:inline-flex"
  role="alert"
  data-te-alert-init
  data-te-autohide="true"
  data-te-delay="1000">
  Text copied!
</div>

      <div class="flex flex-col gap-2 items-center" wire:loading.remove wire:target="compartilhar">
        <button
          id="copy-button"
          type="button"
          data-te-clipboard-init
          data-te-clipboard-target="#copy-target-2"
          data-te-ripple-init
          data-te-ripple-color="light"
          class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
          Copiar Link
        </button>
        @if($selectedBarbearia)
        <div id="copy-target-2" class=" hidden border border-blue-600 rounded-md  p-5 mt-2">http://localhost/{{ $selectedBarbearia->slug }}</div>
        @endif
        </div>
    </div>




    <!--Modal footer-->
    <div
      class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 dark:border-opacity-50">
      <button
        type="button"
        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200"
        data-te-modal-dismiss
        data-te-ripple-init
        data-te-ripple-color="light">
        Fechar
      </button>
    
    </div>
   
  </div>

  
</div>  --}}
<livewire:barbearia-list  /> 


</div>
  <div
    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="pills-profile7"
    role="tabpanel"
    aria-labelledby="pills-profile-tab7"
    wire:ignore.self
 
    >
   


{{-- @can('inscrito', $this->plan)
           --}}
  <!-- Section: Design Block -->
  <section class="mb-3 mt-5">
    <div
      class="relative h-[300px] w-[85%] max-sm:w-[100%] rounded-lg mx-auto overflow-hidden bg-cover bg-[50%] bg-no-repeat" style="background-image: url('{{ asset('fundopreto.jpg') }}')">
    </div>

      <div class="block m-auto w-[80%] max-sm:w-[100%] rounded-lg bg-[hsla(0,0%,100%,0.7)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.7)] dark:shadow-black/20 md:py-16 md:px-12 -mt-[100px] backdrop-blur-[30px] ">
       
       
          <livewire:user-wizard user-id="3"/>
        

    </div>
  </section>
  <!-- Section: Design Block -->

<!-- Container for demo purpose -->
{{-- @else

      <livewire:assinatura />
     
@endcan --}}




  </div>
  <div
    class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
    id="pills-contact7"
    role="tabpanel"
    aria-labelledby="tabs-profile-tab01"
    wire:ignore.self
    >  
    <div class="grid  grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-5 ">
        @foreach(auth()->user()->barbearias as $barbearia)
        <div
        class="mx-auto mb-8 sm:mb-0  block rounded-lg max-w-[450px] bg-white shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)]">
        <div
          class="  relative   overflow-hidden bg-cover bg-no-repeat"
          data-te-ripple-init
          data-te-ripple-color="light">
          <img
            class="rounded-t-lg  object-cover "
            src="{{ asset('storage/' . $barbearia->imagem) }}"
           style="width: 450px; height: 317px;"
            alt="" />
          <a href="/{{$barbearia->slug}}"
            wire:navigate
            >
            <div
              class="absolute bottom-0 left-0 right-0 top-0 h-full w-full overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
          </a>
        </div>
        <div class="p-6">
          <h5
            class="mb-2 text-xl font-medium leading-tight text-neutral-800">
          {{ $barbearia->nome }}
          </h5>
          <p class="mb-2 text-base text-neutral-600">
           Cep:   {{ $barbearia->cep }}
         
          
          </p>
          <p class="mb-2 text-base text-neutral-600">
           
            Rua:   {{ $barbearia->rua }}
           </p>
           <p class="mb-2 text-base text-neutral-600">
           
            Cidade:   {{ $barbearia->cidade }}
           </p>
        
           <p class="mb-4 text-base text-neutral-600">
           
            Estado:   {{ $barbearia->estado }}
           </p>
          <a
          type="button"
          data-te-ripple-init
          data-te-ripple-color="light"
          href="/{{$barbearia->slug}}"
          wire:navigate
          class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-black active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
         Ver Barbearia
        </a>
        </div>
        </div>
        @endforeach
  
    </div>
          </div>
       
       
 

   
  {{--   <div
    class="bg-neutral-100 p-12 text-center text-neutral-700">
    <h2 class="mb-4 text-4xl font-semibold">Barbearia</h2>
    <h4 class="mb-6 text-xl font-semibold">John Alisson</h4>
    <a
      type="button"
      data-te-ripple-init
      data-te-ripple-color="light"
      href="/agendar"
      wire:navigate
      class="rounded bg-black px-7 pb-2.5 pt-3 text-sm font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-gray-900 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-gray-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]">
       Agendar Agora
</a>
  </div> --}}
  <div
  class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
  id="pills-contact8"
  role="tabpanel"
  aria-labelledby="tabs-profile-tab01"
  wire:ignore.self
  >  
       <livewire:agendamentos >
  </div>

</div>