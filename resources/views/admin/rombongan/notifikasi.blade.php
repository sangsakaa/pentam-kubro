<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Notifikasi Pesan Pendaftaran') }}
    </h2>
  </x-slot>
  @if (session('success'))
  <div class="py-4 h1" id="success-message">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <style>
            .h1 {
              background-color: rgba(7, 75, 36, 255);
            }
          </style>
          <div class="  grid grid-cols-1  gap-2">
            <div class=" h1 text-white uppercase text-2xl p-2">
              {{ session('success') }}
            </div>
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
  <div class="py-2 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <div>
            <span>
              Kode Pendaftaran : <br>
            </span>
            <span class=" font-semibold text-2xl">
              {{$kode_pendaftaran->kode_pendaftaran}} <br>
            </span>
            <span>
              Imam Jamah'ah / Ketua Rombongan : <br>
              <p class=" font-semibold uppercase">
                {{$kode_pendaftaran->nama}}
              </p>
            </span>

          </div>
        </div>
      </div>
    </div>
</x-app-layout>