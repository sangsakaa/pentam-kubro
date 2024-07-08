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
              <input type="number" name="kode_pendaftaran" class="w-full py-2" id="kode_pendaftaran" maxlength="20" title="Format harus 07-07-2024-000000001" required>
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

  <div id="captureArea" class="py-2 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class=" bg-white  overflow-hidden shadow-sm sm:rounded-lg">
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
            <div class="grid justify-center justify-items-cneter text-center">
              <h1>Detail Pendaftaran</h1>
              <div class=" grid grid-cols-4 text-xs">
                <div class=" border gap-2">
                  <p> Remaja: <br> {{ $kode_pendaftaran['jumlah_peserta_remaja'] }}</p>
                </div>
                <div class=" border gap-2">
                  <p> Kanak: <br> {{ $kode_pendaftaran['jumlah_peserta_kanak'] }}</p>
                </div>
                <div class=" border gap-2">
                  <p> Ibu: <br>{{ $kode_pendaftaran['jumlah_peserta_ibu'] }}</p>
                </div>
                <div class=" border gap-2">
                  <p> Bapak: <br> {{ $kode_pendaftaran['jumlah_peserta_bapak'] }}</p>
                </div>
              </div>
              Datang : <br>{{ \Carbon\Carbon::parse($kode_pendaftaran['tanggal_berangkat'])->isoFormat('dddd, DD-MMMM-YYYY') }} <br>

              Pulang : <br> {{ \Carbon\Carbon::parse($kode_pendaftaran['tanggal_pulang'])->isoFormat('dddd, DD-MMMM-YYYY') }}
              <p class=" text-xs">Gelombang Acara: <br> {{ implode(", ", json_decode($kode_pendaftaran['gelombang_acara'], true)) }}</p>
            </div>
            @else
            <div class="grid justify-center justify-items-cneter text-center">
              <a href="/generate-reservasi-qr" class="copy-button-1 rounded-md">
                Generate Barcode
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