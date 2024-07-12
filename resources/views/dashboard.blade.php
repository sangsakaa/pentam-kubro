<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Grafik Bar Calon Peserta Kubro') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <div>
          </div>
          <div class=" px-4 py-2">
            <table class=" text-sm   w-full">
              <thead>
                <tr class=" border">
                  <th class="  border" rowspan="2">No</th>
                  <th class="  border" rowspan="2">Kode Pendaftaran</th>
                  <th class="  border" rowspan="2">Gelombang Acara</th>
                  <th class=" border" rowspan="2">Ketua <br> Rombongan</th>
                  <th class=" border" rowspan="2">Provinsi <br>Kota / Kabupaten Kecamatan</th>
                  <th class=" border" colspan="4">Peserta Mujahadah</th>
                  <th class=" border" rowspan="2">Total</th>
                </tr>
                <tr>
                  <th class=" border w-16">Bapak</th>
                  <th class=" border w-16">Ibu</th>
                  <th class=" border w-16">Remaja</th>
                  <th class=" border w-16">Kanak2</th>
                </tr>
              </thead>
              <tbody>
                @foreach($grafikPeserta as $peserta)
                <tr class=" hover:bg-green-200 border even:bg-gray-100">
                  <td class="  border text-center">
                    {{ $loop->iteration }}
                  </td>
                  <td class="  border text-center">
                    {{ $peserta->kode_pendaftaran }}
                  </td>
                  <td class="  border text-center">
                    {{ implode(', ', json_decode($peserta['gelombang_acara'], true)) }}
                  </td>
                  <td class=" border text-left capitalize px-2">{{ $peserta->nama}}</td>
                  <td class=" border text-center">
                    {{ $peserta->province_name }} <br>
                    {{ $peserta->regency_name }}
                    Kec. {{ $peserta->district_name }}
                  </td>
                  <td class=" border text-center">{{ $peserta->jumlah_peserta_bapak }}</td>
                  <td class=" border text-center">{{ $peserta->jumlah_peserta_ibu }}</td>
                  <td class=" border text-center">{{ $peserta->jumlah_peserta_remaja }}</td>
                  <td class=" border text-center">{{ $peserta->jumlah_peserta_kanak }}</td>
                  <td class=" border text-center">
                    {{ $peserta->jumlah_peserta_kanak +
                   $peserta->jumlah_peserta_remaja +
                   $peserta->jumlah_peserta_ibu  +
                   $peserta->jumlah_peserta_bapak }}
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="10">{{$grafikPeserta->links()}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>