<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Checkin') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <!-- <div id="reader" width="600px"></div> -->
          <div id="reader" style="width:300px; height:300px;"></div>

        </div>
      </div>
    </div>
  </div>




  <script>
    let kode_pendaftaran = "";

    function onScanSuccess(decodedText, decodedResult) {
      // Save the scanned code to kode_pendaftaran variable
      kode_pendaftaran = decodedText;
      console.log(`Code matched = ${decodedText}`, decodedResult);
      console.log(`Kode Pendaftaran = ${kode_pendaftaran}`);
    }

    function onScanFailure(error) {
      // handle scan failure, usually better to ignore and keep scanning.
      // for example:
      console.warn(`Code scan error = ${error}`);
    }

    // Request camera permission
    navigator.mediaDevices.getUserMedia({
        video: true
      })
      .then(function(stream) {
        // Permission granted, initialize the scanner
        let html5QrcodeScanner = new Html5QrcodeScanner(
          "reader", {
            fps: 10,
            qrbox: {
              width: 250,
              height: 250
            }
          },
          /* verbose= */
          false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
      })
      .catch(function(err) {
        console.error("Camera permission denied:", err);
      });
  </script>



</x-app-layout>