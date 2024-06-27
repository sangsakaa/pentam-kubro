<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Form Pendaftaran') }}
    </h2>
  </x-slot>
  <!-- kop -->
  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-2 py-2">
          <div>
            <style>
              .h1 {
                background-color: rgba(7, 75, 36, 255);
              }
            </style>
          </div>
          <div class="h1 px-2 py-2 text-white  flex grid-cols-1">
            <div>
              <img src="{{ asset('img/logo.png') }}" height="80px" width="80px" alt="Example Image">
            </div>
            <div>
              Pendaftaran Online <br>
              <span class="  text-2xl">
                Peserta Mujahadah Kubro <br>
              </span>
              Muharram 1446
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="px-2 py-2">
          <div class="h1 px-2 py-2 text-white  flex grid-cols-1">
            <div class="  text-justify text-sm  ">
              <p class=" justified-text ">
                Selamat datang Jama'ah Mujahadah Kubro, <br>
                Silahkan lakukan pengisian pendaftaran peserta dengan benar di bawah ini : NB : *berikan saran kepada panitia terhadap pelayanan dan fasilitas yang ada *setelah pengisian peserta wajib mengambil kartu peserta di panitia dengan bukti formulir pendaftaran online•⁠ ⁠setelah pendaftaran wajib mengambil kartu peserta di stand penerimaan tamu
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- endkop -->
  <div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class=" px-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">


        <div class=" grid">

        </div>
        <form action="/rombongan-kubro/kabupaten" method="post">
          @csrf
          <div class=" grid grid-cols-1 gap-2 py-2">

            <input type="text" name="nama" placeholder=" nama ketua rombongan">
            <select class="text-sm" id="provinsi" name="province">
              <option value="">Pilih Provinsi</option>
              @foreach($provinces as $province)
              <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
              @endforeach
            </select>
            <select class="text-sm" id="kabupaten" name="kabupaten" disabled>
              <option value="">Pilih Kabupaten</option>
            </select>
            <input type="text" name="tempat_acara" placeholder=" Tempat Transit">
            <input type="number" name="jumlah_peserta_bapak" placeholder=" jumlah_peserta_bapak">
            <input type="number" name="jumlah_peserta_ibu" placeholder=" jumlah_peserta_ibu">
            <input type="number" name="jumlah_peserta_remaja" placeholder=" jumlah_peserta_remaja">
            <input type="number" name="jumlah_peserta_kanak" placeholder=" jumlah_peserta_kanak">
            <label for="">
              Tanggal Berangkat
            </label>
            <input class=" w-full" type="date" name="tanggal_berangkat" placeholder=" tanggal_berangkat ketua rombongan">
            <select class="text-sm" name="kendaraan" id="">
              <option value="">Jenis Transportasi</option>
              <option value="Mobil">Mobil</option>
              <option value="Bus">Bus</option>
              <option value="Kereta Api">Kereta Api</option>
              <option value="Pesawat">Pesawat</option>
              <option value="Sepeda Motor">Sepeda Motor</option>
              <option value="Elf">Mobil Elf</option>
            </select>
            <div>
              <label for="">Pilih Gelombang Yang ikuti</label>
            </div>
            <div class=" grid-cols-1">
              <input type="checkbox" name="gelombang_acara[]" id="gelombang1" value="Khodimul">
              <label for="gelombang1">Gelombang 1 Khodimul</label><br>
              <input type="checkbox" name="gelombang_acara[]" id="gelombang2" value="Ibu-Ibu">
              <label for="gelombang2">Gelombang 2 Ibu-Ibu</label><br>
              <input type="checkbox" name="gelombang_acara[]" id="gelombang3" value="Remaja">
              <label for="gelombang3">Gelombang 3 Remaja</label><br>
              <input type="checkbox" name="gelombang_acara[]" id="gelombang4" value="Kanak-Kanak">
              <label for="gelombang4">Gelombang 4 Kanak-Kanak</label><br>
              <input type="checkbox" name="gelombang_acara[]" id="gelombang5" value="Bapak-Bapak">
              <label for="gelombang5">Gelombang 5 Bapak-Bapak</label><br>
            </div>
            <textarea name="sarat" id="" placeholder="saran"></textarea>
          </div>
          <button class=" bg-purple-700 text-white px-2 py-1" type="submit">Daftar Calon Peserta</button>
        </form>
      </div>
    </div>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#provinsi').on('change', function() {
        var provinceCode = $(this).val();

        if (provinceCode) {
          $.ajax({
            url: '/dashboard/' + provinceCode,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
              $('#kabupaten').empty().append('<option value="">Loading...</option>').prop('disabled', true);
            },
            success: function(data) {
              $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
              $.each(data, function(key, kabupaten) {
                $('#kabupaten').append('<option value="' + kabupaten.code + '">' + kabupaten.name + '</option>');
              });
              $('#kabupaten').prop('disabled', false);
            },
            error: function() {
              $('#kabupaten').empty().append('<option value="">Error loading data</option>').prop('disabled', true);
            }
          });
        } else {
          $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>').prop('disabled', true);
        }
      });
    });
  </script>
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
</x-app-layout>