<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Form Pendaftaran' )
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
              <span>
                Pendaftaran Online <br>
              </span>
              <span class="  text-2xl">
                Peserta Mujahadah Kubro <br>
              </span>
              <span>
                Muharram 1446
              </span>
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
                Silahkan lakukan pengisian pendaftaran peserta dengan benar di bawah ini : <br>NB : *berikan saran kepada panitia terhadap pelayanan dan fasilitas yang ada *setelah pengisian peserta wajib mengambil kartu peserta di panitia dengan bukti formulir pendaftaran online.⁠setelah pendaftaran wajib mengambil kartu peserta di stand penerimaan tamu
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
      <div class=" px-4 py-4 bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class=" grid">
        </div>
        <form action="/rombongan-kubro/kabupaten/kecamatan" method="post">
          @csrf
          <div class=" grid grid-cols-1 gap-2 py-2">
            <input required type="text" name="nama" placeholder="nama lengkap Ketua Rombongan">
            <input required type="text" id="no_hp_ketua" name="no_hp_ketua" placeholder="Nomor HP Ketua Rombongan">
            <script>
              document.getElementById('no_hp_ketua').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters

                // Format the number according to Indonesian phone number format
                if (value.startsWith('08')) {
                  value = value.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1-$2-$3').replace(/-$/, '');
                } else {
                  value = '08' + value;
                  value = value.replace(/(\d{4})(\d{4})(\d{0,4})/, '$1-$2-$3').replace(/-$/, '');
                }

                e.target.value = value;
              });
            </script>
            <select required class="text-sm" id="provinsi" name="province">
              <option value="">Pilih Provinsi</option>
              @foreach($provinces as $province)
              <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
              @endforeach
            </select>
            <select required class="text-sm" id="kabupaten" name="kabupaten" disabled>
              <option value="">Pilih Kabupaten</option>
            </select>
            <select required class="text-sm" id="kecamatan" name="kecamatan" disabled>
              <option value="">Pilih Kecamatan</option>
            </select>
            <input type="number" name="jumlah_peserta_bapak" placeholder=" jumlah_peserta_bapak">
            <input type="number" name="jumlah_peserta_ibu" placeholder=" jumlah_peserta_ibu">
            <input type="number" name="jumlah_peserta_remaja" placeholder=" jumlah_peserta_remaja">
            <input type="number" name="jumlah_peserta_kanak" placeholder=" jumlah_peserta_kanak">
            <input hidden type="text" name="tempat_acara" placeholder=" Tempat Transit">
            <select required class="text-sm" name="jenis_lokasi" id="">
              <option value="">Jenis Lokasi</option>
              <option value="Area Lapangan">Area Lapangan</option>
              <option value="Kos">Kos</option>
              <option value="Hotel">Hotel</option>
              <option value="Homestay">Homestay</option>
              <option value="Kontrakan">Kontrakan</option>
            </select>
            <input type="text" name="nama_lokasi" placeholder=" nama_lokasi">
            <input type="text" id="biaya" name="biaya" placeholder=" biaya">
            <label for="">
              Tanggal Tiba / Kedatangan
            </label>
            <input required class=" w-full" type="date" name="tanggal_berangkat" placeholder=" tanggal_berangkat ketua rombongan">
            <label for="">
              Tanggal Kembali / kepulangan
            </label>
            <input required class=" w-full" type="date" name="tanggal_pulang" placeholder=" tanggal_pulang ketua rombongan">
            <select required class="text-sm" name="kendaraan" id="">
              <option value="">Jenis Transportasi</option>
              <option value="Mobil">Mobil</option>
              <option value="Bus">Bus</option>
              <option value="Kereta Api">Kereta Api</option>
              <option value="Pesawat">Pesawat</option>
              <option value="Sepeda Motor">Sepeda Motor</option>
              <option value="Elf">Mobil Elf</option>
            </select>
            <script>
              document.getElementById('biaya').addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^0-9]/g, ''); // Remove all non-digit characters

                if (value) {
                  // Add period as thousands separator
                  value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                  value = 'Rp .' + value;
                }

                e.target.value = value;
              });
            </script>
            <div>
              <label for="">Pilih Gelombang Yang diikuti</label> <br>
            </div>
            <div class=" grid grid-cols-2">
              <div>
                <input type="checkbox" name="gelombang_acara[]" id="gelombang1" value="Khodimul">
                <label for="gelombang1">1 Khodimul</label><br>
              </div>
              <div>
                <input type="checkbox" name="gelombang_acara[]" id="gelombang4" value="Kanak-Kanak">
                <label for="gelombang4">4 Kanak-Kanak</label><br>
              </div>
              <div>
                <input type="checkbox" name="gelombang_acara[]" id="gelombang2" value="Ibu-Ibu">
                <label for="gelombang2">2 Ibu-Ibu</label><br>
              </div>
              <div>
                <input type="checkbox" name="gelombang_acara[]" id="gelombang5" value="Bapak-Bapak">
                <label for="gelombang5">5 Bapak-Bapak</label><br>
              </div>
              <div>
                <input type="checkbox" name="gelombang_acara[]" id="gelombang3" value="Remaja">
                <label for="gelombang3">3 Remaja</label><br>
              </div>
            </div>
            <textarea name="sarat" id="" placeholder="saran"></textarea>
          </div>
          <button class="h1  text-white px-2 py-1" type="submit">Daftar Peserta</button>
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

      $('#kabupaten').on('change', function() {
        var kabupatenCode = $(this).val();
        if (kabupatenCode) {
          $.ajax({
            url: '/dashboard/kecamatan/' + kabupatenCode,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
              $('#kecamatan').empty().append('<option value="">Loading...</option>').prop('disabled', true);
            },
            success: function(data) {
              $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
              $.each(data, function(key, kecamatan) {
                $('#kecamatan').append('<option value="' + kecamatan.code + '">' + kecamatan.name + '</option>');
              });
              $('#kecamatan').prop('disabled', false);
            },
            error: function() {
              $('#kecamatan').empty().append('<option value="">Error loading data</option>').prop('disabled', true);
            }
          });
        } else {
          $('#kecamatan').empty().append('<option value="">Pilih Kecamatan</option>').prop('disabled', true);
        }
      });
    });

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

</x-app-layout>