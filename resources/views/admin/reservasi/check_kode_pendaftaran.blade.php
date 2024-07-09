<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Check Kode Pendaftaran') }}
    </h2>
  </x-slot>

  <div class="mt-4 mb-4">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <form action="/check-kode" method="get">
            <div class="grid gap-2">
              <input type="text" placeholder="07-07-2024-000000001" name="kode_pendaftaran" class="w-full py-2 text-center" id="kode_pendaftaran" maxlength="20" title="Format harus 07-07-2024-000000001" required>
              <button class="copy-button-1 bg-blue-700 text-white px-2 py-1">Cari Kode Pendaftaran</button>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
          </form>
          @if (!is_null($kode_pendaftaran) && $kode_pendaftaran->count() > 0 && file_exists(storage_path('app/public/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg')))
          <div class="flex gap-2 justify-center justify-items-center">
            <button class="copy-button-1" id="captureBtn">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
              </svg>
            </button>
            <a href="/cetak-kartu/{{$kode_pendaftaran->kode_pendaftaran}}" target="_blank" class="copy-button-1 rounded-md">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
              </svg>

            </a>
            <button class="copy-button" onclick="copyToClipboard()">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
              </svg>
            </button>
          </div>
          @else
          @endif
          <script>
            document.getElementById('captureBtn').addEventListener('click', function() {
              html2canvas(document.getElementById('captureArea')).then(function(canvas) {
                // Convert canvas to image
                var imgData = canvas.toDataURL('image/png');

                // Create a link element
                var link = document.createElement('a');
                link.href = imgData;
                link.download = 'capture.png';

                // Append the link to the body
                document.body.appendChild(link);

                // Programmatically click the link to trigger the download
                link.click();

                // Remove the link from the document
                document.body.removeChild(link);
              });
            });
          </script>
          <script>
            document.getElementById('kode_pendaftaran').addEventListener('input', function(e) {
              let value = e.target.value.replace(/\D/g, '');
              if (value.length > 9) {
                value = value.slice(0, 2) + '-' + value.slice(2, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8, 17);
              } else if (value.length > 4) {
                value = value.slice(0, 2) + '-' + value.slice(2, 4) + '-' + value.slice(4);
              } else if (value.length > 2) {
                value = value.slice(0, 2) + '-' + value.slice(2);
              }
              e.target.value = value;
            });
          </script>
        </div>
      </div>
    </div>
  </div>
  <style>
    .h1 {
      background-color: rgba(7, 75, 36, 255);
      color: white;

    }
  </style>
  <div class=" pb-10 px-2 w-full shadow-md ">
    <div class="  py-2 rounded-lg   px-2">
      <div class="h1 px-2"></div>
      <div id="captureArea" class="   bg-white rounded-lg  overflow-hidden shadow-md sm:rounded-lg">
        <table class=" ">
          <tr class="h1 ">
            <td class="logo">
              <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" height="80px" width="50px" alt="Example Image">
            </td>
            <td>
              <span class=" kop-1 text-xs">
                PENERIMA TAMU MUJAHADAH KUBRO
              </span>
            </td>
          </tr>
        </table>
        <div class="py-6 px-2">
          <div>
            @if (!is_null($kode_pendaftaran) && $kode_pendaftaran->count() > 0 && file_exists(storage_path('app/public/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg')))
            <div class="grid justify-center justify-items-center">
              <img width="150px" src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(storage_path('app/public/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg'))) }}" alt="QR Code">
            </div>
            <div class="grid justify-center justify-items-cneter text-center">
              <span>
                Kode Pendaftaran<br>
              </span>
              <span class="font-semibold text-lg" id="kodePendaftaran">
                {{$kode_pendaftaran->kode_pendaftaran}} <br>
                <span class=" ">
                  {{$kode_pendaftaran->nama}}
                </span>
                <br>
              </span>
              <span>
                Imam Jamah'ah / Ketua Rombongan
              </span>
            </div>
            <div class=" w-full grid grid-cols-1 justify-center justify-items-cneter text-center">
              <style>
                table {
                  margin-top: 10px;
                  width: 100%;
                }

                table.tr.th {
                  margin-left: 10px;
                }
              </style>
              <h1>Detail Pendaftaran</h1>
              <table class=" py-2  text-xs w-full">
                <thead>
                  <tr class=" border">
                    <th class=" border py-2">Remaja</th>
                    <th class=" border py-2">Kanak2</th>
                    <th class=" border py-2">Ibu2</th>
                    <th class=" border py-2">Bapak2</th>
                  </tr>
                  <tr class=" border">
                    <td class="border py-2 px-4">{{$kode_pendaftaran->jumlah_peserta_remaja}}</td>
                    <td class="border py-2 px-4">{{$kode_pendaftaran->jumlah_peserta_kanak}}</td>
                    <td class="border py-2 px-4">{{$kode_pendaftaran->jumlah_peserta_ibu}}</td>
                    <td class="border py-2 px-4">{{$kode_pendaftaran->jumlah_peserta_bapak}}</td>
                  </tr>
                </thead>
                <tr>
                  <td class=" text-center py-2 font-semibold border " colspan="4">
                    <span>Gelombang Acara :</span> <br>
                    {{ \Carbon\Carbon::parse($kode_pendaftaran['tanggal_berangkat'])->locale('id')->isoFormat('dddd, DD-MMMM-YYYY') }}
                  </td>
                </tr>
                <tr>
                  <td class=" text-center py-2 font-semibold border " colspan="4">
                    <span>Gelombang Acara :</span> <br>
                    {{ \Carbon\Carbon::parse($kode_pendaftaran->tanggal_pulang)->locale('id')->isoFormat('dddd, DD-MMMM-YYYY') }}
                  </td>
                </tr>
                <tr>
                  <td colspan="4" class=" border text-center px-1">
                    <span>Gelombang Acara :</span> <br>
                    {{ implode(', ', json_decode($kode_pendaftaran['gelombang_acara'], true)) }}
                  </td>
                </tr>
                <tbody>
              </table>
            </div>
            @else
            <div class="grid justify-center justify-items-cneter text-center">
              <a href="/generate-reservasi-qr" class="copy-button-1 rounded-md">
                Kembali Ke Beranda
              </a>
              <span>KLIK TOMBOL GENERATE BARCODE <br> UNTUK MENDAPATAN KARTU</span>
            </div>
            @endif
            <script>
              function copyToClipboard() {
                // Get the text from the span
                var kodePendaftaran = document.getElementById("kodePendaftaran").innerText;

                // Create a temporary textarea element
                var tempTextArea = document.createElement("textarea");
                tempTextArea.value = kodePendaftaran;

                // Append the textarea to the body (needed for the copy command)
                document.body.appendChild(tempTextArea);

                // Select the text
                tempTextArea.select();
                tempTextArea.setSelectionRange(0, 99999); // For mobile devices

                // Copy the text to the clipboard
                document.execCommand("copy");

                // Remove the temporary textarea element
                document.body.removeChild(tempTextArea);
                // Optional: Notify the user that the text has been copied
                alert("Kode Pendaftaran copied to clipboard: " + kodePendaftaran);
              }
            </script>
          </div>
          <div class="h1 h-10 ">
            <div class=" text-xs justify-between text-center py-4">
              PANITIA PELAKSANA MUJAHADAH KUBRO &copy2024
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>
<style>
  .copy-button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }

  .copy-button-1 {
    background-color: purple;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
  }
</style>