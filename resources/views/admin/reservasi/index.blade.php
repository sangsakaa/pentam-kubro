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
          <button id="refreshTable">Refresh Tabel</button>
          <table id="data-table" class="w-full">
            <thead>
              <tr class=" border">
                <th rowspan="2" class=" border">ID</th>
                <th rowspan="2" class=" border">Kode Pendaftaran</th>
                <th rowspan="2" class=" border">Nama</th>
                <th colspan="4" class=" border"> Peserta Mujahadah</th>
                <th rowspan="2" class=" border">Provinsi</th>
                <th rowspan="2" class=" border">Gelombang <br> Acara</th>
                <th rowspan="2" class=" border">Tempat <br> Acara</th>
                <th rowspan="2" class=" border">Tanggal <br> Berangkat</th>
                <th rowspan="2" class=" border">ACT</th>
              </tr>
              <tr class=" border">
                <th class=" border"> Remaja</th>
                <th class=" border"> Kanak</th>
                <th class=" border"> Ibu</th>
                <th class=" border"> Bapak</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservation as $data)
              <tr class=" border">
                <td class=" border text-center px-1">{{ $data['id'] }}</td>
                <td class=" border text-center px-1">{{ $data['kode_pendaftaran'] }} <br>{{ $data['qr_code'] }}</td>
                <td class=" border text-center px-1">{{ $data['nama'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_remaja'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_kanak'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_ibu'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_bapak'] }}</td>
                <td class=" border text-center px-1">{{ $data['province'] }} {{ $data['kabupaten'] }} {{ $data['kecamatan'] }}</td>
                <td class=" border text-center px-1">{{ implode(', ', json_decode($data['gelombang_acara'], true)) }}</td>
                <td class=" border text-center px-1">{{ $data['tempat_acara'] }}</td>
                <td class=" border text-center px-1">{{ $data['tanggal_berangkat'] }}</td>
                <td class=" border text-center px-1">
                  <form action="/reservasi-kehadiran/{{ $data['id'] }}" method="post">
                    @csrf
                    @method('delete')
                    <button class=" ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      function refreshTable() {
        $.ajax({
          url: '/path/to/your/backend/script', // Ganti dengan URL endpoint backend Anda
          type: 'GET',
          dataType: 'json',
          success: function(data) {
            $('#data-table tbody').empty();
            $.each(data, function(index, item) {
              var newRow = '<tr class="border">' +
                '<td class="border text-center px-1">' + item.id + '</td>' +
                '<td class="border text-center px-1">' + item.kode_pendaftaran + '<br>' + item.qr_code + '</td>' +
                '<td class="border text-center px-1">' + item.nama + '</td>' +
                '<td class="border text-center px-1">' + item.jumlah_peserta_remaja + '</td>' +
                '<td class="border text-center px-1">' + item.jumlah_peserta_kanak + '</td>' +
                '<td class="border text-center px-1">' + item.jumlah_peserta_ibu + '</td>' +
                '<td class="border text-center px-1">' + item.jumlah_peserta_bapak + '</td>' +
                '<td class="border text-center px-1">' + item.province + ' ' + item.kabupaten + ' ' + item.kecamatan + '</td>' +
                '<td class="border text-center px-1">' + item.gelombang_acara.join(', ') + '</td>' +
                '<td class="border text-center px-1">' + item.tempat_acara + '</td>' +
                '<td class="border text-center px-1">' + item.tanggal_berangkat + '</td>' +
                '<td class="border text-center px-1">' +
                '<form action="/reservasi-kehadiran/' + item.id + '" method="post">' +
                '@csrf' +
                '@method("delete")' +
                '<button class=" ">' +
                '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">' +
                '<path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />' +
                '</svg>' +
                '</button>' +
                '</form>' +
                '</td>' +
                '</tr>';
              $('#data-table tbody').append(newRow);
            });
          },
          error: function(xhr, status, error) {
            console.error('Error: ' + status + ' - ' + error);
          }
        });
      }

      $('#refreshTable').on('click', function() {
        refreshTable();
      });

      // Set interval to automatically refresh the table every 10 seconds (10000 milliseconds)
      setInterval(refreshTable, 10000);
    });
  </script>


</x-app-layout>