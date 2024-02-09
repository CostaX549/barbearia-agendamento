                  
    <form wire:submit="responder({{ $avaliacao->id }})">
        <div class="w-full px-3 mb-2 mt-6">
          <textarea
                  class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-400 focus:outline-none focus:bg-white"
                  name="body" placeholder="Comment" wire:model="resposta"></textarea>
      </div>
    
      <div class="w-full flex justify-end px-3 my-3">
          <input type="submit" class="px-2.5 py-1.5 rounded-md text-white text-sm bg-indigo-500 text-lg" value='Post Comment'>
      </div>
    
    </div>
    
    </div>
    <!-- END Reply Container  -->
  </form>

