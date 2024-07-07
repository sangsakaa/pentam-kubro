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
        <div class="p-4">
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
        <div class="p-4">
          <div class="  grid grid-cols-1 gap-2">
            <a href="/form-daftar" class=" copy-button-1">kembali ke Form Pendaftaran</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-2 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="py-6 px-2">
          <div>
            @if ($kode_pendaftaran->count() > 0 && file_exists(storage_path('app/public/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg')))
            <div class=" grid justify-center justify-items-center">
              <img width="150px" src="data:image/svg+xml;base64,{{ base64_encode(file_get_contents(storage_path('app/public/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg'))) }}" alt="QR Code">
            </div>
            <div class=" grid justify-center justify-items-cneter text-center">
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
            <div class=" grid justify-center justify-items-center  ">
              <a href="/cetak-kartu/{{$kode_pendaftaran->kode_pendaftaran}}" target="_blank" class=" copy-button-1  rounded-md">
                Download Kartu Peserta
              </a>
              <button class="copy-button" onclick="copyToClipboard()">Copy Kode Pendaftaran</button>
            </div>
            @else
            <div class=" grid justify-center justify-items-cneter text-center">
              <a href="/generate-reservasi-qr" class=" copy-button-1  rounded-md">
                Generate Barcode
              </a>
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
</x-app-layout>