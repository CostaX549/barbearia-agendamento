<div x-data="{ previewImagem: null }">
  <label class="mb-5 mt-5 block text-xl font-semibold text-black">
      Enviar Imagem
  </label>

  <label for="file" class="cursor-pointer relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
      <input type="file" id="file" wire:model="state.imagem" class="sr-only" x-on:change="previewImagem = $event.target.files[0]">
      <span class="hover:bg-gray-100 inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-black">Enviar</span>

   
  </label>
  <div class="mb-4 mt-3">
    <img :src="previewImagem ? URL.createObjectURL(previewImagem) : ''" id="image-preview" class="h-auto max-w-[350px] rounded-lg mx-auto" alt="">
</div>
</div>
