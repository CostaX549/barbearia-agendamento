<div>
  
    <div class="w-fullbg-white rounded-lg border p-1 md:p-3 m-10">
      <h3 class="font-semibold p-1">Discussion</h3>
      <div class="flex flex-col gap-5 m-3">
        @forelse($this->avaliacoes as $avaliacao)
          <!-- Comment Container -->
          <div>
              <div class="flex w-full justify-between border rounded-md">
    
                  <div class="p-3">
                      <div class="flex gap-3 items-center">
                          <img src="{{ $avaliacao->user->profile_photo_url }}"
                                  class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400  shadow-emerald-400">
                          <h3 class="font-bold">
                              {{$avaliacao->user->name}}
                              <br>
                              
                          </h3>
          
      
      <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
      <ul
        class="ratingStar my-1 mb-4 flex list-none gap-1 p-0"
        id="teste"
        wire:ignore
    
        data-te-readonly="true"
        data-te-value="{{ $avaliacao->qtd }}">
        <li>
          <span
            class="text-black [&>svg]:h-5 [&>svg]:w-5"
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
            class="text-black [&>svg]:h-5 [&>svg]:w-5"
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
            class="text-black [&>svg]:h-5 [&>svg]:w-5"
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
            class="text-black [&>svg]:h-5 [&>svg]:w-5"
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
            class="text-black [&>svg]:h-5 [&>svg]:w-5"
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
                         
                      </div>
                    
                      <p class="text-gray-600 mt-2">
                          {{$avaliacao->comment}}
                      </p>
                     
                  </div>
    
    
                  <div class="flex flex-col items-end gap-3 pr-3 py-3">
                      <div>
                          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 24 24" stroke-width="5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                          </svg>
                      </div>
                      <div>
                          <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 24 24" stroke-width="5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                          </svg>
                      </div>
                  </div>
    
              </div>
       
       
    
    
              <!-- Reply Container  -->
              <div class="text-gray-300 font-bold pl-14">|</div>
              <div class="flex justify-between border ml-5  rounded-md ">
                <div class="comment">
                  @can('create', $this->barbearia)
                  <button class="reply-btn">Responder</button>
                 @else 
                 <button class="reply-btn">Respostas</button>
                 @endcan
                <div class="reply-form" style="display: none;">
                    @forelse($avaliacao->respostas as $resposta)
                  <div class="p-3">
                    <div class="flex gap-3 items-center">
                        <img src="{{ $resposta->user->profile_photo_url }}"
                                class="object-cover w-10 h-10 rounded-full border-2 border-emerald-400  shadow-emerald-400">
                        <h3 class="font-bold">
                  {{ $resposta->user->name }}
                            <br>
                            <span class="text-sm text-gray-400 font-normal">Level 1</span>
                        </h3>
                    </div>
                    <p class="text-gray-600 mt-2">
                     {{ $resposta->text }}
                    </p>
                    
                </div>
                @empty 
                <p>Nenhum comentário</p>
             @endforelse   
                  
       @can('create', $barbearia)
<livewire:responder :avaliacao="$avaliacao" :key="$avaliacao->id" />
@endcan
    
    
</div>  
  
    
      

    
    
    

 
    </div>
        
    @empty
    <p>Nenhum Comentário</p>
@endforelse
    </div>
  </div>
@if($barbearia->avaliacoes()->where('user_id', auth()->user()->id)->count() < 1)
      <div class="w-full px-3 mb-2 mt-6">
        <ul  wire:ignore id="selected-value-example" class="ratingStar my-1 flex list-none gap-1 p-0">
          <li>
            <span
              class="text-black [&>svg]:h-5 [&>svg]:w-5"
              title="Bad"
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
              class="text-black [&>svg]:h-5 [&>svg]:w-5"
              title="Poor"
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
              class="text-black [&>svg]:h-5 [&>svg]:w-5"
              title="OK"
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
              class="text-black [&>svg]:h-5 [&>svg]:w-5"
              title="Good"
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
              class="text-black [&>svg]:h-5 [&>svg]:w-5"
              title="Excellent"
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
      
          <textarea
                  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
                  wire:model ="comment" placeholder="Comment" required></textarea>
      </div>
    
      <div class="w-full flex justify-end px-3 my-3">
          <input type="submit"   id="botaoAvaliar"
          data-barbearia-id="{{$barbearia->id}}"
          type="button"
        wire:loading.class="opacity-50"
        wire:loading.attr="disabled"
          class="inline-block  w-200 bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]" class="px-2.5 py-1.5 rounded-md text-white  bg-indigo-500 text-lg" value='Post Comment'>
      </div>
      @endif

      
</div>
