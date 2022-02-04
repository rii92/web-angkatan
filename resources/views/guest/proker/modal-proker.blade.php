<div>
  <x-modal.body class=" mx-0">
    <div>
      <img class="object-cover h-48 w-full rounded-md" src="{{ $proker['src'] }}" alt="{{ $proker['title'] }}" />
    </div>
    <div class="font-sans py-4 px-5">
      <h3 class="md:text-xl text-lg font-semibold text-orange-400 font-poppins mb-3">{{ $proker['title'] }}</h3>
      <p class="md:text-lg">{{ $proker['desc'] }}</p>
    </div>
  </x-modal.body>
  <x-modal.footer>
    <x-button.secondary wire:click="$emit('closeModal')">
      Close
    </x-button.secondary>
  </x-modal.footer>
</div>