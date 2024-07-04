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
        <div class="p-4">
          <h1>QR Code Scanner</h1>
          <div id="reader"></div>
          <div id="result"></div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function onScanSuccess(decodedText, decodedResult) {
      // Handle the result here.
      console.log(`Code matched = ${decodedText}`, decodedResult);
      document.getElementById('result').innerText = `Scanned result: ${decodedText}`;
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