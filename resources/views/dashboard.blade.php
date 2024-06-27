<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Grafik Bar Calon Peserta Kubro') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">

          <table class=" w-full">
            <thead>
              <tr class=" border">
                <th>kode Pendaftar</th>
                <th>Ketua Rombongan</th>
                <th>Provinsi - Kota / Kabupaten</th>
                <th>Bapak-Bapak</th>
                <th>Ibu-Ibu</th>
                <th>Remaja</th>
                <th>Kanak-Kanak</th>
                <th>Total <br> Peserta</th>
              </tr>
            </thead>
            <tbody>
              @foreach($grafikPeserta as $peserta)
              <tr class=" border">
                <td class=" text-center">{{ $peserta->kode_pendaftaran }}</td>
                <td class=" text-left capitalize">{{ $peserta->nama}}</td>
                <td class=" text-center">
                  {{ $peserta->province_name }} <br>
                  {{ $peserta->regency_name }}
                </td>
                <td class=" text-center">{{ $peserta->jumlah_peserta_bapak }}</td>
                <td class=" text-center">{{ $peserta->jumlah_peserta_ibu }}</td>
                <td class=" text-center">{{ $peserta->jumlah_peserta_remaja }}</td>
                <td class=" text-center">{{ $peserta->jumlah_peserta_kanak }}</td>
                <td class=" text-center">
                  {{ $peserta->jumlah_peserta_kanak +
                   $peserta->jumlah_peserta_remaja +
                   $peserta->jumlah_peserta_ibu  +
                   $peserta->jumlah_peserta_bapak }}

                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>