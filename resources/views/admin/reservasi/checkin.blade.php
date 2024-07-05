<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Checkin') }}
    </h2>
  </x-slot>
  <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>

  <div class="py-12">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 text-center">
          <div id="reader"></div>
          <p id="result">Scanned result: None</p>
        </div>
      </div>
    </div>
  </div>


  <script>
    function onScanSuccess(decodedText, decodedResult) {
      // Handle the result here.
      console.log(`Code matched = ${decodedText}`, decodedResult);
      document.getElementById('result').innerText = `Scanned result: ${decodedText}`;

      // Make an AJAX request to check and store the QR code in the controller
      fetch('/reservasi-qr', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // for Laravel
          },
          body: JSON.stringify({
            qrCode: decodedText
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.registered) {
            // Notify that the QR code is already registered
            alert('QR Code sudah terdaftar.');
          } else {
            // Notify that the QR code has been successfully registered
            alert('QR Code berhasil didaftarkan.');
          }
        })
        .catch((error) => console.error('Error:', error));
    }

    function onScanFailure(error) {
      // Handle the scan failure, usually better to ignore and keep scanning.
      console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
      "reader", {
        fps: 10,
        qrbox: 250
      });
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
  </script>




</x-app-layout>