<section class="py-1 md:py-16 lg:py-16">
  <div class="container mx-auto px-4">
  @if($all)
  <div class="w-full  px-4" >
    <div class="max-w-full lg:max-w-full mx-auto lg:mr-0">
      <svg  class=" ml-auto cursor-pointer w-5 h-5 "  wire:click="voltar" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
      </svg>
      
      @foreach($this->avaliacoes as $avaliacao)
      <div class="mb-12 pb-12 border-b border-gray-200">
        <div class="max-w-xl">
          <div class="flex mb-6 items-center">
            <div class="mr-4">
              <img src="{{ $avaliacao->user->profile_photo_url }}" class="rounded-full" alt="">
            </div>
            <div>
              <span class="block mb-1 font-bold text-black">{{ $avaliacao->user->name }}</span>
              <ul
          
              wire:ignore

              class="my-1 flex list-none gap-1 p-0"
            >
            @for ($i = 1; $i <= 5; $i++)
            <li wire:ignore>
                <span
                    class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                    wire:ignore
                
                >

                @if ($i <= $avaliacao->qtd)
                <svg xmlns="http://www.w3.org/2000/svg" 
                fill="blue"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" 
           fill="none"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
           </svg>
           @endif
                </span>
            </li>
        @endfor
            </ul>
            </div>
          </div>
          <p class="text-gray-400">{{ $avaliacao->comment }}</p>
        </div>
      </div>
      @endforeach
    
  </div>
</div>
  @else

    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0">
        <div class="max-w-md mx-auto lg:mx-0">
          <h4 class="font-heading text-2xl text-black font-bold mb-3">Avaliações dos Clientes</h4>
          <div class="flex items-start mb-8">
            <div class="flex items-center">
              <svg width="116" height="23" viewbox="0 0 116 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.2387 4.44347C10.5774 3.40101 12.0522 3.40101 12.3909 4.44347L13.6012 8.16814C13.7526 8.63434 14.1871 8.94998 14.6773 8.94998H18.5936C19.6897 8.94998 20.1455 10.3526 19.2587 10.9969L16.0903 13.2989C15.6937 13.587 15.5278 14.0977 15.6793 14.5639L16.8895 18.2886C17.2282 19.331 16.0351 20.1979 15.1483 19.5536L11.9799 17.2517C11.5833 16.9635 11.0463 16.9635 10.6497 17.2517L7.48135 19.5536C6.59458 20.1979 5.40143 19.331 5.74015 18.2886L6.95037 14.5639C7.10185 14.0977 6.9359 13.587 6.53933 13.2989L3.37093 10.9969C2.48416 10.3526 2.9399 8.94998 4.03601 8.94998H7.95236C8.44256 8.94998 8.877 8.63434 9.02848 8.16814L10.2387 4.44347Z" fill="#EDFF7C"></path>
                <path d="M33.5795 4.44347C33.9182 3.40101 35.393 3.40101 35.7318 4.44347L36.942 8.16814C37.0935 8.63434 37.5279 8.94998 38.0181 8.94998H41.9344C43.0306 8.94998 43.4863 10.3526 42.5995 10.9969L39.4311 13.2989C39.0346 13.587 38.8686 14.0977 39.0201 14.5639L40.2303 18.2886C40.569 19.331 39.3759 20.1979 38.4891 19.5536L35.3207 17.2517C34.9241 16.9635 34.3871 16.9635 33.9906 17.2517L30.8222 19.5536C29.9354 20.1979 28.7423 19.331 29.081 18.2886L30.2912 14.5639C30.4427 14.0977 30.2767 13.587 29.8801 13.2989L26.7118 10.9969C25.825 10.3526 26.2807 8.94998 27.3768 8.94998H31.2932C31.7834 8.94998 32.2178 8.63434 32.3693 8.16814L33.5795 4.44347Z" fill="#EDFF7C"></path>
                <path d="M56.9213 4.44347C57.26 3.40101 58.7348 3.40101 59.0736 4.44347L60.2838 8.16814C60.4353 8.63434 60.8697 8.94998 61.3599 8.94998H65.2762C66.3724 8.94998 66.8281 10.3526 65.9413 10.9969L62.7729 13.2989C62.3764 13.587 62.2104 14.0977 62.3619 14.5639L63.5721 18.2886C63.9108 19.331 62.7177 20.1979 61.8309 19.5536L58.6625 17.2517C58.2659 16.9635 57.7289 16.9635 57.3324 17.2517L54.164 19.5536C53.2772 20.1979 52.084 19.331 52.4228 18.2886L53.633 14.5639C53.7845 14.0977 53.6185 13.587 53.2219 13.2989L50.0536 10.9969C49.1668 10.3526 49.6225 8.94998 50.7186 8.94998H54.635C55.1252 8.94998 55.5596 8.63434 55.7111 8.16814L56.9213 4.44347Z" fill="#EDFF7C"></path>
                <path d="M80.2631 4.44347C80.6018 3.40101 82.0766 3.40101 82.4154 4.44347L83.6256 8.16814C83.7771 8.63434 84.2115 8.94998 84.7017 8.94998H88.618C89.7142 8.94998 90.1699 10.3526 89.2831 10.9969L86.1147 13.2989C85.7182 13.587 85.5522 14.0977 85.7037 14.5639L86.9139 18.2886C87.2526 19.331 86.0595 20.1979 85.1727 19.5536L82.0043 17.2517C81.6077 16.9635 81.0707 16.9635 80.6742 17.2517L77.5058 19.5536C76.619 20.1979 75.4258 19.331 75.7646 18.2886L76.9748 14.5639C77.1263 14.0977 76.9603 13.587 76.5637 13.2989L73.3953 10.9969C72.5086 10.3526 72.9643 8.94998 74.0604 8.94998H77.9768C78.467 8.94998 78.9014 8.63434 79.0529 8.16814L80.2631 4.44347Z" fill="#EDFF7C"></path>
                <path d="M103.605 4.44347C103.944 3.40101 105.418 3.40101 105.757 4.44347L106.967 8.16814C107.119 8.63434 107.553 8.94998 108.043 8.94998H111.96C113.056 8.94998 113.512 10.3526 112.625 10.9969L109.457 13.2989C109.06 13.587 108.894 14.0977 109.045 14.5639L110.256 18.2886C110.594 19.331 109.401 20.1979 108.515 19.5536L105.346 17.2517C104.95 16.9635 104.413 16.9635 104.016 17.2517L100.848 19.5536C99.9608 20.1979 98.7676 19.331 99.1064 18.2886L100.317 14.5639C100.468 14.0977 100.302 13.587 99.9055 13.2989L96.7371 10.9969C95.8504 10.3526 96.3061 8.94998 97.4022 8.94998H101.319C101.809 8.94998 102.243 8.63434 102.395 8.16814L103.605 4.44347Z" fill="#EDFF7C"></path>
              </svg>
            </div>
            <span class="ml-2 text-sm text-gray-300">Baseado em {{  $this->barbearia->avaliacoes->count()}} avaliações</span>
          </div>
          <div class="mb-12">
            <div class="flex -mx-2 mb-4 items-center">
              <div class="w-2/12 md:w-1/12 px-2">
                <div class="flex items-center">
                  <span class="mr-2 text-sm font-bold text-gray-600">5</span>
                  <span>
                    <svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.04917 0.927067C7.34853 0.00575608 8.65193 0.00575656 8.95129 0.927067L10.0209 4.21886C10.1547 4.63089 10.5387 4.90985 10.9719 4.90985H14.4331C15.4018 4.90985 15.8046 6.14946 15.0209 6.71886L12.2207 8.75331C11.8702 9.00795 11.7236 9.45932 11.8575 9.87134L12.927 13.1631C13.2264 14.0844 12.1719 14.8506 11.3882 14.2812L8.58801 12.2467C8.23753 11.9921 7.76293 11.9921 7.41244 12.2467L4.61227 14.2812C3.82856 14.8506 2.77408 14.0844 3.07343 13.1631L4.143 9.87134C4.27688 9.45932 4.13022 9.00795 3.77973 8.75331L0.979561 6.71886C0.195848 6.14946 0.598623 4.90985 1.56735 4.90985H5.02855C5.46177 4.90985 5.84573 4.63089 5.9796 4.21886L7.04917 0.927067Z" fill="#EDFF7C"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="w-8/12 md:w-9/12 sm:w-10/12 px-2">
                <div class="relative pt-3 w-full bg-gray-800">
                  <div class="absolute top-0 start-0 h-full px-16 bg-yellow-400"></div>
                </div>
              </div>
              <div class="w-2/12 sm:w-1/12 px-2">
                <span class="text-sm font-medium text-white">63%</span>
              </div>
            </div>
            <div class="flex -mx-2 mb-4 items-center">
              <div class="w-2/12 md:w-1/12 px-2">
                <div class="flex items-center">
                  <span class="mr-2 text-sm font-bold text-black">4</span>
                  <span>
                    <svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.04917 0.927067C7.34853 0.00575608 8.65193 0.00575656 8.95129 0.927067L10.0209 4.21886C10.1547 4.63089 10.5387 4.90985 10.9719 4.90985H14.4331C15.4018 4.90985 15.8046 6.14946 15.0209 6.71886L12.2207 8.75331C11.8702 9.00795 11.7236 9.45932 11.8575 9.87134L12.927 13.1631C13.2264 14.0844 12.1719 14.8506 11.3882 14.2812L8.58801 12.2467C8.23753 11.9921 7.76293 11.9921 7.41244 12.2467L4.61227 14.2812C3.82856 14.8506 2.77408 14.0844 3.07343 13.1631L4.143 9.87134C4.27688 9.45932 4.13022 9.00795 3.77973 8.75331L0.979561 6.71886C0.195848 6.14946 0.598623 4.90985 1.56735 4.90985H5.02855C5.46177 4.90985 5.84573 4.63089 5.9796 4.21886L7.04917 0.927067Z" fill="#EDFF7C"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="w-8/12 md:w-9/12 sm:w-10/12 px-2">
                <div class="relative pt-3 w-full bg-gray-800">
                  <div class="absolute top-0 start-0 h-full px-5 bg-yellow-400"></div>
                </div>
              </div>
              <div class="w-2/12 sm:w-1/12 px-2">
                <span class="text-sm font-medium text-white">10%</span>
              </div>
            </div>
            <div class="flex -mx-2 mb-4 items-center">
              <div class="w-2/12 md:w-1/12 px-2">
                <div class="flex items-center">
                  <span class="mr-2 text-sm font-bold text-black">3</span>
                  <span>
                    <svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.04917 0.927067C7.34853 0.00575608 8.65193 0.00575656 8.95129 0.927067L10.0209 4.21886C10.1547 4.63089 10.5387 4.90985 10.9719 4.90985H14.4331C15.4018 4.90985 15.8046 6.14946 15.0209 6.71886L12.2207 8.75331C11.8702 9.00795 11.7236 9.45932 11.8575 9.87134L12.927 13.1631C13.2264 14.0844 12.1719 14.8506 11.3882 14.2812L8.58801 12.2467C8.23753 11.9921 7.76293 11.9921 7.41244 12.2467L4.61227 14.2812C3.82856 14.8506 2.77408 14.0844 3.07343 13.1631L4.143 9.87134C4.27688 9.45932 4.13022 9.00795 3.77973 8.75331L0.979561 6.71886C0.195848 6.14946 0.598623 4.90985 1.56735 4.90985H5.02855C5.46177 4.90985 5.84573 4.63089 5.9796 4.21886L7.04917 0.927067Z" fill="#EDFF7C"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="w-8/12 md:w-9/12 sm:w-10/12 px-2">
                <div class="relative pt-3 w-full bg-gray-800">
                  <div class="absolute top-0 start-0 h-full px-3 bg-yellow-400"></div>
                </div>
              </div>
              <div class="w-2/12 sm:w-1/12 px-2">
                <span class="text-sm font-medium text-white">6%</span>
              </div>
            </div>
            <div class="flex -mx-2 mb-4 items-center">
              <div class="w-2/12 md:w-1/12 px-2">
                <div class="flex items-center">
                  <span class="mr-2 text-sm font-bold text-black">2</span>
                  <span>
                    <svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.04917 0.927067C7.34853 0.00575608 8.65193 0.00575656 8.95129 0.927067L10.0209 4.21886C10.1547 4.63089 10.5387 4.90985 10.9719 4.90985H14.4331C15.4018 4.90985 15.8046 6.14946 15.0209 6.71886L12.2207 8.75331C11.8702 9.00795 11.7236 9.45932 11.8575 9.87134L12.927 13.1631C13.2264 14.0844 12.1719 14.8506 11.3882 14.2812L8.58801 12.2467C8.23753 11.9921 7.76293 11.9921 7.41244 12.2467L4.61227 14.2812C3.82856 14.8506 2.77408 14.0844 3.07343 13.1631L4.143 9.87134C4.27688 9.45932 4.13022 9.00795 3.77973 8.75331L0.979561 6.71886C0.195848 6.14946 0.598623 4.90985 1.56735 4.90985H5.02855C5.46177 4.90985 5.84573 4.63089 5.9796 4.21886L7.04917 0.927067Z" fill="#EDFF7C"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="w-8/12 md:w-9/12 sm:w-10/12 px-2">
                <div class="relative pt-3 w-full bg-gray-800">
                  <div class="absolute top-0 start-0 h-full px-7 bg-yellow-400"></div>
                </div>
              </div>
              <div class="w-2/12 sm:w-1/12 px-2">
                <span class="text-sm font-medium text-white">12%</span>
              </div>
            </div>
            <div class="flex -mx-2 mb-4 items-center">
              <div class="w-2/12 md:w-1/12 px-2">
                <div class="flex items-center">
                  <span class="mr-2 text-sm font-bold text-black">1</span>
                  <span>
                    <svg width="16" height="15" viewbox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.04917 0.927067C7.34853 0.00575608 8.65193 0.00575656 8.95129 0.927067L10.0209 4.21886C10.1547 4.63089 10.5387 4.90985 10.9719 4.90985H14.4331C15.4018 4.90985 15.8046 6.14946 15.0209 6.71886L12.2207 8.75331C11.8702 9.00795 11.7236 9.45932 11.8575 9.87134L12.927 13.1631C13.2264 14.0844 12.1719 14.8506 11.3882 14.2812L8.58801 12.2467C8.23753 11.9921 7.76293 11.9921 7.41244 12.2467L4.61227 14.2812C3.82856 14.8506 2.77408 14.0844 3.07343 13.1631L4.143 9.87134C4.27688 9.45932 4.13022 9.00795 3.77973 8.75331L0.979561 6.71886C0.195848 6.14946 0.598623 4.90985 1.56735 4.90985H5.02855C5.46177 4.90985 5.84573 4.63089 5.9796 4.21886L7.04917 0.927067Z" fill="#EDFF7C"></path>
                    </svg>
                  </span>
                </div>
              </div>
              <div class="w-8/12 md:w-9/12 sm:w-10/12 px-2">
                <div class="relative pt-3 w-full bg-gray-800">
                  <div class="absolute top-0 start-0 h-full px-5 bg-yellow-400"></div>
                </div>
              </div>
              <div class="w-2/12 sm:w-1/12 px-2">
                <span class="text-sm font-medium text-white">9%</span>
              </div>
            </div>
          </div>
          <div>
            <h5 class="text-xl text-white font-medium mb-2">Share your thoughts</h5>
            <p class="max-w-xs font-sm text-gray-400 mb-8">You made it so simple. My new site is so much faster andin easier to work with.</p>
            <a class="relative group block h-12 px-8 py-3 text-center font-bold text-black transition duration-200 overflow-hidden" href="#">
              <div class="absolute top-0 left-0 w-full h-24 transform -translate-y-8 group-hover:-translate-y-1 transition duration-500 bg-gradient-to-br from-yellow-500 via-green-300 to-blue-500"></div>
              <span class="relative">Write a Review</span>
            </a>
            <a class="relative group block h-12  mt-5 px-8 py-3 text-center font-bold text-black transition duration-200 overflow-hidden cursor-pointer" wire:click="seeAll">
              <div class="absolute top-0 left-0 w-full h-24 transform -translate-y-8 group-hover:-translate-y-1 transition duration-500 bg-gradient-to-br from-yellow-500 via-green-300 to-blue-500"></div>
              <span class="relative">Ver todas as avaliações</span>
            </a>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-1/2 px-4" >
        <div class="max-w-md lg:max-w-2xl mx-auto lg:mr-0">
          @foreach($this->avaliacoes->take(3) as $avaliacao)
        {{--   <div class="mb-12 pb-12 border-b border-gray-200">
            <div class="max-w-xl">
              <div class="flex mb-6 items-center">
                <div class="mr-4">
                  <img src="{{ $avaliacao->user->profile_photo_url }}" class="rounded-full" alt="">
                </div>
                <div>
                  <span class="block mb-1 font-bold text-black">{{ $avaliacao->user->name }}</span>
                  <ul wire:ignore
                  class="my-1 flex list-none gap-1 p-0"
                 >
              
                  @for ($i = 1; $i <= 5; $i++)
                      <li wire:ignore>
                          <span
                              class="text-primary [&>svg]:h-5 [&>svg]:w-5"
                              wire:ignore
                          
                          >

                          @if ($i <= $avaliacao->qtd)
                          <svg xmlns="http://www.w3.org/2000/svg" 
                          fill="blue"
                               viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                          </svg>
                          @else
                          <svg xmlns="http://www.w3.org/2000/svg" 
                     fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                     </svg>
                     @endif
                          </span>
                      </li>
                  @endfor
              </ul>
                </div>
              </div>
              <p class="text-gray-400">{{ $avaliacao->comment }}</p>
            </div>
          </div> --}}

          <div class="mb-12 flex flex-wrap md:mb-0">
            <div class="w-full md:w-2/12 shrink-0 grow-0 basis-auto">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(24).jpg"
                class="mb-6 w-full rounded-lg shadow-lg dark:shadow-black/20" alt="Avatar" />
            </div>
      
            <div class="w-full md:w-10/12 shrink-0 grow-0 basis-auto md:pl-6">
              <p class="mb-3 font-semibold">Marta Dolores</p>
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Distinctio est ab iure inventore dolorum consectetur? Molestiae
                aperiam atque quasi consequatur aut? Repellendus alias dolor ad
                nam, soluta distinctio quis accusantium!
              </p>
            </div>
          </div>
          @endforeach
        
      </div>
    </div>
@endif

  </div>


</section>