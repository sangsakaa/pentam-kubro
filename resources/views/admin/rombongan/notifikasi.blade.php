<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Notifikasi Pesan Pendaftaran') }}
    </h2>
  </x-slot>
  @if (session('success'))
  <div class="py-12" id="success-message">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <style>
            h1 {
              background-color: green;
            }
          </style>
          <div class="grid grid-cols-1 gap-2">
            <h1>
              <div class="text-white">
                {{ session('success') }}
              </div>
            </h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Hide the success message after 10 seconds
    setTimeout(function() {
      document.getElementById('success-message').style.display = 'none';
    }, 10000); // 10000 milliseconds = 10 seconds
  </script>
  @endif
  <div class="py-2 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <div class="  grid grid-cols-1 gap-2">
            <a href="/form-daftar" class=" bg-purple-700 text-white px-2 py-1 rounded-md">kembali ke Form Pendaftaran</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>