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
            <a href="/form-daftar" class=" copy-button-1">kembali ke Form Pendaftaran</a>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="py-2 px-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-12">
          <h1>QR Code</h1>
          <div>
            @if($kode_pendaftaran && $kode_pendaftaran->kode_pendaftaran)
            <a href="/generate-reservasi-qr" class=" copy-button-1 rounded-md">
              Generate Barcode
            </a>
            @php
            $qrCodePath = 'storage/qrcodes/' . $kode_pendaftaran->kode_pendaftaran . '.svg';
            @endphp
            @if(File::exists(public_path($qrCodePath)))
            <img src="{{ asset($qrCodePath) }}" alt="QR Code">
            @else
            <img src="{{ asset('qrcodes/placeholder.svg') }}" alt="Placeholder QR Code">
            @endif
            @endif
            <span>
              Kode Pendaftaran : <br>
            </span>
            <span class="font-semibold text-lg" id="kodePendaftaran">
              {{$kode_pendaftaran->nama}} <br>
            </span>
            <span>
              Imam Jamah'ah / Ketua Rombongan : <br>
              <p class="font-semibold uppercase">
                {{$kode_pendaftaran->nama}}
              </p>
            </span>

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
            <div class="  ">
              <a href="/cetak-kartu/{{$kode_pendaftaran->kode_pendaftaran}}" target="_blank" class=" copy-button-1  rounded-md">
                Download Kartu Peserta
              </a>

              <button class="copy-button" onclick="copyToClipboard()">Copy Kode Pendaftaran</button>
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
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>