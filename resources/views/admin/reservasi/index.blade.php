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
          <table id="data-table" class="w-full">
            <thead>
              <tr class=" border">
                <th rowspan="2" class=" border">ID</th>
                <th rowspan="2" class=" border">Kode Pendaftaran</th>
                <th rowspan="2" class=" border">Nama</th>
                <th colspan="4" class=" border"> Peserta Mujahadah</th>

                <th rowspan="2" class=" border">Provinsi</th>
                <th rowspan="2" class=" border">Gelombang Acara</th>
                <th rowspan="2" class=" border">Tempat Acara</th>
                <th rowspan="2" class=" border">Gelombang Acara</th>
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
                <td class=" border text-center px-1">
                  {{ $data['id'] }}
                </td>
                <td class=" border text-center px-1">
                  {{ $data['kode_pendaftaran'] }} <br>
                  {{ $data['qr_code'] }}
                </td>
                <td class=" border text-center px-1">{{ $data['nama'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_remaja'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_kanak'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_ibu'] }}</td>
                <td class=" border text-center px-1">{{ $data['jumlah_peserta_bapak'] }}</td>
                <td class=" border text-center px-1">
                  {{ $data['province'] }}
                  {{ $data['kabupaten'] }}
                  {{ $data['kecamatan'] }}
                </td>
                <td class=" border text-center px-1">{{ implode(', ', json_decode($data['gelombang_acara'], true)) }}</td>
                <td class=" border text-center px-1">{{ $data['tempat_acara'] }}</td>
                <td class=" border text-center px-1">{{ $data['tanggal_berangkat'] }}</td>
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
      // Fungsi untuk memuat ulang tabel
      function refreshTable() {
        $.ajax({
          url: '/path/to/your/backend/script', // Ganti dengan URL endpoint backend Anda
          type: 'GET', // Atur metode HTTP yang sesuai
          dataType: 'json', // Atur tipe data yang diharapkan dari respons

          success: function(data) {
            // Hapus semua baris (kecuali header) dari tabel
            $('#data-table tbody').empty();

            // Tambahkan data baru ke tabel
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
                '</tr>';
              $('#data-table tbody').append(newRow);
            });
          },
          error: function(xhr, status, error) {
            console.error('Error: ' + status + ' - ' + error);
            // Tindakan yang sesuai jika permintaan gagal
          }
        });
      }

      // Event handler untuk tombol refresh
      $('#refreshTable').on('click', function() {
        refreshTable(); // Panggil fungsi refreshTable saat tombol diklik
      });
    });
  </script>

</x-app-layout>