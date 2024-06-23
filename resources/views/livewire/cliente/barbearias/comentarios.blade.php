<div class=" flex flex-col  ">
  <div class="w-[500px]  m-auto">
   
  <div class="flex  justify-center items-center mb-2 ">
    <div class="flex justify-center items-center  mb-2">
      @for ($i = 1; $i <= 5; $i++)
          @if($i <= floor($this->media))
              <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
              </svg>
          @elseif($i <= ceil($this->media) && $this->media != floor($this->media))
              <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <defs>
                      <linearGradient id="half-gradient">
                          <stop offset="50%" stop-color="currentColor"/>
                          <stop offset="50%" stop-color="gray"/>
                      </linearGradient>
                  </defs>
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" fill="url(#half-gradient)"/>
              </svg>
          @else
              <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                  <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
              </svg>
          @endif
      @endfor
  </div>


  <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{$this->media}}</p>
  <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">de</p>
  <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">5</p>

 

  </div>
 
  <p class="text-sm text-center  font-medium text-gray-500 dark:text-gray-400">{{$this->avaliacoes->count()}} Avaliações</p>

  
  

 <div class="w-[500px] m-auto">
  
 
@foreach($this->avaliacoes as $avaliacao)
<article wire:key="{{ $avaliacao->id}}">
  <div class="flex items-center mb-4 ">
      <img class="w-10 h-10 me-4 rounded-full" src="{{ $avaliacao->user->profile_photo_url }}" alt="">
      <div class="font-medium dark:text-white">
          <p>{{ $avaliacao->user->name }} <time datetime="2014-08-16 19:00" class="block text-sm text-gray-500 dark:text-gray-400"></time></p>
      </div>
  </div>
  <div class="flex items-center mb-1 space-x-1 rtl:space-x-reverse">
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
      <h3 class="ms-2 text-sm font-semibold text-gray-900 dark:text-white">Obrigado pela avaliação</h3>
  </div>
  <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400"><p> <time datetime={{ $avaliacao->created_at }}>{{ $avaliacao->created_at }}</time></p></footer>
  <p class="mb-2 text-gray-500 dark:text-gray-400">{{  $avaliacao->comment }}</p>


  <aside>
     
  </aside>
</article>
@endforeach


  

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
              wire:model ="comment" placeholder="Avaliação" required></textarea>
  </div>

  <div class="w-full flex justify-end px-3 my-3">
      <input type="submit"   id="botaoAvaliar"
      data-barbearia-id="{{$barbearia->id}}"
      type="button"
    wire:loading.class="opacity-50"
    wire:loading.attr="disabled"
      class="inline-block  w-200 bg-neutral-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-neutral-50 shadow-[0_4px_9px_-4px_rgba(51,45,45,0.7)] transition duration-150 ease-in-out hover:bg-neutral-800 hover:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:bg-neutral-800 focus:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] focus:outline-none focus:ring-0 active:bg-neutral-900 active:shadow-[0_8px_9px_-4px_rgba(51,45,45,0.2),0_4px_18px_0_rgba(51,45,45,0.1)] dark:bg-neutral-900 dark:shadow-[0_4px_9px_-4px_#030202] dark:hover:bg-neutral-900 dark:hover:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:focus:bg-neutral-900 dark:focus:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)] dark:active:bg-neutral-900 dark:active:shadow-[0_8px_9px_-4px_rgba(3,2,2,0.3),0_4px_18px_0_rgba(3,2,2,0.2)]" class="px-2.5 py-1.5 rounded-md text-white  bg-indigo-500 text-lg" value='Avalie a Barbearia'>
  </div>
  <script>
    let valorAvaliado = 0; // Inicialize com um valor padrão ou 0
const icons = document.querySelectorAll('#selected-value-example [data-te-rating-icon-ref]');

icons.forEach((el) => {
  
    el.addEventListener('onSelect.te.rating', (e) => {
        
        valorAvaliado = e.value;
    });
});
document.getElementById('botaoAvaliar').addEventListener('click', (e) => {
  e.stopPropagation();
var barbeariaId = document.getElementById('botaoAvaliar').getAttribute('data-barbearia-id');

console.log('Barbearia ID:', barbeariaId);

Livewire.dispatch('avaliar', {
valor: valorAvaliado,
id: barbeariaId,

});

});   
  </script>


 
  

  
</div>
