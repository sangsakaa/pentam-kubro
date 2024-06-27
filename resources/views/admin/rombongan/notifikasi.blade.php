<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Notifikasi Pesan Pendaftaran') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <div class="  grid grid-cols-1 gap-2">
            @if (session('success'))
            <div class=" bg-purple-700 text-white">
              {{ session('success') }}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <div class="  grid grid-cols-1 gap-2">
            <a href="/form-daftar" class=" bg-purple-700 text-white px-2 py-1 rounded-md">kembalikan ke Form Pendaftaran</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>