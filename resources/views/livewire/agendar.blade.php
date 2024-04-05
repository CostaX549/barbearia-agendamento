
<div>
<div class="w-full px-6 py-6 mx-auto">
  <!-- table 1 -->

  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Contratados</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
        
            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Usuário</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Function</th>
                  <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                  <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Contratado</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                </tr>
              </thead>
              <tbody>
           
                @foreach($barbearia->barbeiros()->withTrashed()->get() as $barbeiro)

              
                <tr>
                
                  <td class="p-2 align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    <div class="flex px-2 py-1">
                      <div>
                        <img src="{{ $barbeiro->user->profile_photo_url }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl" alt="user1" />
                      </div>
                      <div class="flex flex-col justify-center">
                        <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $barbeiro->user->name }} @if(auth()->user()->id == $barbeiro->user->id) (Você mesmo) @endif</h6>
                      <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{  $barbeiro->user->email }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">Manager</p>
                    <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">Organization</p>
                  </td>
                  <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    <span class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Online</span>
                  </td>
                  <td class="p-2 text-center align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $barbearia->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="p-2 align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }}  whitespace-nowrap shadow-transparent">
                    <input type="radio"   wire:model.change="barbeiros" value="{{ $barbeiro->id }}" id="checkbox_{{$barbeiro->id}}">
                   
                  </td>
                </tr>

        
            
              @endforeach
               
              </tbody>
            </table>
        
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- card 2 -->


  <div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
          <h6 class="dark:text-white">Agendamentos do Contratado</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
          <div class="p-0 overflow-x-auto">
         
            <table class="items-center justify-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
              <thead class="align-bottom">
                <tr>
                  <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Data</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total de Serviços</th>
                  <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Concluído as</th>
                  <th class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Ações</th>
                  <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-solid shadow-none dark:border-white/40 dark:text-white tracking-none whitespace-nowrap"></th>
                </tr>
              </thead>
              <tbody class="border-t">
                @foreach($this->agendamentosFiltrados ?? [] as $agendamento)
                <tr>
                  <td class="p-2 align-middle bg-transparent{{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                      <div class="flex px-2">
                          <div>
                            <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-calendar-grid-58 mr-2"></i>
                          </div>
                          <div class="my-auto">
                              <h6 class="mb-0 text-sm leading-normal dark:text-white">{{$agendamento->start_date->format('d/m/Y H:i') }}</h6>
                          </div>
                      </div>
                  </td>
                  <td class="p-2 align-middle bg-transparent{{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                      <p class="mb-0 text-sm font-semibold leading-normal dark:text-white dark:opacity-60">R${{ $agendamento->total_price}}</p>
                  </td>
                  <td class="p-2 align-middle bg-transparent{{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    <span class="text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                        {{ isset($agendamento->deleted_at) ? $agendamento->deleted_at->format('d/m/Y H:i') : "Não concluído" }}
                    </span>
                </td>
                  <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent {{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                    @if($agendamento->deleted_at)
                    <span class="bg-gradient-to-tl from-red-600 to-orange-600  cursor-pointer 0 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" wire:click="cancelar({{ $agendamento->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-50" wire:target="cancelar({{ $agendamento->id }})">Cancelar</span>
                    @else
                    <span class="bg-gradient-to-tl from-emerald-500 cursor-pointer to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" wire:click="concluir({{ $agendamento->id }})" wire:loading.attr="disabled" wire:loading.class="opacity-80" wire:target="concluir({{ $agendamento->id }})">Concluir</span>
                    @endif
                  </td>
                  <td class="p-2 align-middle bg-transparent{{ !$loop->last ? ' border-b dark:border-white/40' : '' }} whitespace-nowrap shadow-transparent">
                      <button class="inline-block px-5 py-2.5 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-normal text-sm ease-in bg-150 tracking-tight-rem bg-x-25 text-slate-400">
                          <i class="text-xs leading-tight fa fa-ellipsis-v dark:text-white dark:opacity-60"></i>
                      </button>
                  </td>
              </tr>
                
                @endforeach

              </tbody>
              <div class="flex justify-center pb-5">
                {{ $this->agendamentosFiltrados?->links() }}

</div>
            </table>
          
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>