


<div>

      <!-- cards -->
      <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
          <!-- card1 -->
          <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Ganhos de Hoje</p>
                      <h5 class="mb-2 font-bold dark:text-white">R${{ $this->totalhoje }}</h5>

                      
                      <p class="mb-0 dark:text-white dark:opacity-60">
                      
                        @if($this->diferencapercentual > 0)
                        <span class="text-sm font-bold leading-normal text-emerald-500">{{ $this->diferencapercentual }}%</span>
                        @else
                        <span class="text-sm font-bold leading-normal text-red-500">{{ $this->diferencapercentual }}%</span>
                        @endif
                   
                        desde ontem
                      </p>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                      <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- card2 -->
          <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Usuários de Hoje</p>
                      <h5 class="mb-2 font-bold dark:text-white">{{$this->usersToday}}</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                        @if($this->usersPorcentagem > 0)
                        <span class="text-sm font-bold leading-normal text-emerald-500">{{$this->usersPorcentagem}}%</span>
                        @else
                        <span class="text-sm font-bold leading-normal text-red-500">{{$this->usersPorcentagem}}%</span>
                        @endif
                        desde a última semana
                      </p>
                    </div>
                  </div>
                
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                      <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>
          </div>

          <!-- card3 -->
          <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Novos Clientes</p>
                      <h5 class="mb-2 font-bold dark:text-white">{{ $this->usersLastQuarterComparison['usuarios_ultimo_trimestre_atual'] }}</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                        @if( $this->usersLastQuarterComparison['porcentagem_aumento'] < 0)
                        <span class="text-sm font-bold leading-normal text-red-600">{{ $this->usersLastQuarterComparison['porcentagem_aumento'] }}</span>
                        @else 
                        <span class="text-sm font-bold leading-normal text-emerald-500">{{ $this->usersLastQuarterComparison['porcentagem_aumento'] }}%</span>
                        @endif
                       desde o último trimestre
                      </p>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                      <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- card4 -->
          <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Sales</p>
                      <h5 class="mb-2 font-bold dark:text-white">R${{ $this->totalMes['total_mes_atual'] }}</h5>
                      <p class="mb-0 dark:text-white dark:opacity-60">
                        @if( $this->totalMes['diferenca'] < 0)
                        <span class="text-sm font-bold leading-normal text-red-600">{{ $this->totalMes['diferenca'] }}</span>
                        @else 
                        <span class="text-sm font-bold leading-normal text-emerald-500">{{ $this->totalMes['diferenca'] }}%</span>
                        @endif
                        desde o último mês
                      </p>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                      <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- cards row 2 -->
    
        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none mb-6">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
              <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white">Quantidade de Agendamentos</h6>
                <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                  <i class="fa fa-arrow-up text-emerald-500"></i>
                  <span class="font-semibold">4% more</span> in 2021
                </p>
              </div>
              <div class="flex-auto p-4">
                <div>
                  <canvas id="chart-line" height="300"></canvas>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
              <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                <h6 class="capitalize dark:text-white">Vendas</h6>
                <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                  <i class="fa fa-arrow-up text-emerald-500"></i>
                  <span class="font-semibold">4% more</span> in 2021
                </p>
              </div>
              <div class="flex-auto p-4">
                <div>
                  <canvas id="chart-sales" height="300"></canvas>
                  
                </div>
              </div>
            </div>
          </div>
         
        
           
        
        
      

          <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
              <!-- slide 1 -->
              <div slide class="absolute w-full h-full transition-all duration-500">
                <img class="object-cover h-full" src="../assets/img/carousel-1.jpg" alt="carousel image" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                  <div class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-camera-compact"></i>
                  </div>
                  <h5 class="mb-1 text-white">Get started with Argon</h5>
                  <p class="dark:opacity-80">There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                </div>
              </div>
              

              <!-- slide 2 -->
              <div slide class="absolute w-full h-full transition-all duration-500">
                <img class="object-cover h-full" src="../assets/img/carousel-2.jpg" alt="carousel image" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                  <div class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-bulb-61"></i>
                  </div>
                  <h5 class="mb-1 text-white">Faster way to create web pages</h5>
                  <p class="dark:opacity-80">That’s my skill. I’m not really specifically talented at anything except for the ability to learn.</p>
                </div>
              </div>

              <!-- slide 3 -->
              <div slide class="absolute w-full h-full transition-all duration-500">
                <img class="object-cover h-full" src="../assets/img/carousel-3.jpg" alt="carousel image" />
                <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                  <div class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-trophy"></i>
                  </div>
                  <h5 class="mb-1 text-white">Share with us your design tips!</h5>
                  <p class="dark:opacity-80">Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                </div>
              </div>

              <!-- Control buttons -->
              <button btn-next class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
              <button btn-prev class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
            </div>
          </div>
        </div>

        <!-- cards row 3 -->

        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
              <div class="p-4 pb-0 mb-0 rounded-t-4">
                <div class="flex justify-between">
                  <h6 class="mb-2 dark:text-white">Agendamentos por Serviço</h6>
                </div>
              </div>
              <div class="overflow-x-auto">
                <table class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                  <tbody>
                    @foreach($this->barbearia->barbeiros()->withTrashed()->get() as $barbeiro)
                    @foreach($barbeiro->cortes as $corte)
                    @if(!$loop->last)
                    <tr>
                      <td class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                        <div class="flex items-center px-2 py-1">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
                            </svg>
                            
                          </div>
                          <div class="ml-6">
                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Serviço:</p>
                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $corte->corte->nome }}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                        <div class="text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Quantidade:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $corte->corte->agendamentos()->onlyTrashed()->count() }}</h6>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                        <div class="text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Vendas:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">R${{ $corte->corte->agendamentos()->onlyTrashed()->count() * $corte->corte->preco }}</h6>
                        </div>
                      </td>
                      <td class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                        <div class="flex-1 text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Bounce:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">29.9%</h6>
                        </div>
                      </td>
                    </tr>
                    @else 
                    <tr>
                      <td class="p-2 align-middle bg-transparent  w-3/10 whitespace-nowrap dark:border-white/40">
                        <div class="flex items-center px-2 py-1">
                          <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m7.848 8.25 1.536.887M7.848 8.25a3 3 0 1 1-5.196-3 3 3 0 0 1 5.196 3Zm1.536.887a2.165 2.165 0 0 1 1.083 1.839c.005.351.054.695.14 1.024M9.384 9.137l2.077 1.199M7.848 15.75l1.536-.887m-1.536.887a3 3 0 1 1-5.196 3 3 3 0 0 1 5.196-3Zm1.536-.887a2.165 2.165 0 0 0 1.083-1.838c.005-.352.054-.695.14-1.025m-1.223 2.863 2.077-1.199m0-3.328a4.323 4.323 0 0 1 2.068-1.379l5.325-1.628a4.5 4.5 0 0 1 2.48-.044l.803.215-7.794 4.5m-2.882-1.664A4.33 4.33 0 0 0 10.607 12m3.736 0 7.794 4.5-.802.215a4.5 4.5 0 0 1-2.48-.043l-5.326-1.629a4.324 4.324 0 0 1-2.068-1.379M14.343 12l-2.882 1.664" />
                            </svg>
                            
                          </div>
                          <div class="ml-6">
                            <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Serviço:</p>
                            <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $corte->corte->nome }}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent  whitespace-nowrap dark:border-white/40">
                        <div class="text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Quantidade:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $corte->corte->agendamentos()->onlyTrashed()->count() }}</h6>
                        </div>
                      </td>
                      <td class="p-2 align-middle bg-transparent  whitespace-nowrap dark:border-white/40">
                        <div class="text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Vendas:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">R${{ $corte->corte->agendamentos()->onlyTrashed()->count() * $corte->corte->preco }}</h6>
                        </div>
                      </td>
                      <td class="p-2 text-sm leading-normal align-middle bg-transparent whitespace-nowrap dark:border-white/40">
                        <div class="flex-1 text-center">
                          <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">Bounce:</p>
                          <h6 class="mb-0 text-sm leading-normal dark:text-white">29.9%</h6>
                        </div>
                      </td>
                    </tr>

                    @endif
                    @endforeach
                    @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
            <div class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
              <div class="p-4 pb-0 rounded-t-4">
                <h6 class="mb-0 dark:text-white">Categories</h6>
              </div>
              <div class="flex-auto p-4">
                <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                  <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-t-lg rounded-xl text-inherit">
                    <div class="flex items-center">
                      <div class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                        <i class="text-white ni ni-mobile-button relative top-0.75 text-xxs"></i>
                      </div>
                      <div class="flex flex-col">
                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Devices</h6>
                        <span class="text-xs leading-tight dark:text-white/80">250 in stock, <span class="font-semibold">346+ sold</span></span>
                      </div>
                    </div>
                    <div class="flex">
                      <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i></button>
                    </div>
                  </li>
                  <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit">
                    <div class="flex items-center">
                      <div class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                        <i class="text-white ni ni-tag relative top-0.75 text-xxs"></i>
                      </div>
                      <div class="flex flex-col">
                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Tickets</h6>
                        <span class="text-xs leading-tight dark:text-white/80">123 closed, <span class="font-semibold">15 open</span></span>
                      </div>
                    </div>
                    <div class="flex">
                      <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i></button>
                    </div>
                  </li>
                  <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-b-lg rounded-xl text-inherit">
                    <div class="flex items-center">
                      <div class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                        <i class="text-white ni ni-box-2 relative top-0.75 text-xxs"></i>
                      </div>
                      <div class="flex flex-col">
                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Error logs</h6>
                        <span class="text-xs leading-tight dark:text-white/80">1 is active, <span class="font-semibold">40 closed</span></span>
                      </div>
                    </div>
                    <div class="flex">
                      <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i></button>
                    </div>
                  </li>
                  <li class="relative flex justify-between py-2 pr-4 border-0 rounded-b-lg rounded-xl text-inherit">
                    <div class="flex items-center">
                      <div class="inline-block w-8 h-8 mr-4 text-center text-black bg-center shadow-sm fill-current stroke-none bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 rounded-xl">
                        <i class="text-white ni ni-satisfied relative top-0.75 text-xxs"></i>
                      </div>
                      <div class="flex flex-col">
                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">Happy users</h6>
                        <span class="text-xs leading-tight dark:text-white/80"><span class="font-semibold">+ 430 </span></span>
                      </div>
                    </div>
                    <div class="flex">
                      <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white"><i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i></button>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

     
</div>
</div>