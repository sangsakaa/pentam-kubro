<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Check Out') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <livewire:reservation-show />
          <script>
            document.addEventListener('livewire:load', function() {
              setInterval(function() {
                Livewire.emit('refreshReservations');
              }, 1); // Adjust the interval (5000 ms = 5 seconds) as needed
            });
          </script>

        </div>
      </div>
    </div>
  </div>


</x-app-layout>