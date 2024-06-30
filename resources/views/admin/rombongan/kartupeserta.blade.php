<div>
  <div>
    <style>
      #container {
        display: flex;
        align-items: center;
      }

      #logo {
        margin-right: 20px;
        /* Adjust this value to control the space between logo and title */
      }

      #tittle {
        display: flex;
        flex-direction: column;
      }

      #tittle span {
        text-align: left;
      }
    </style>
    <div class="h1 px-2 py-2 text-white  flex grid-cols-1">
      <div id="container">
        <div id="logo">
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" height="80px" width="80px" alt="Example Image">
        </div>
        <div id="tittle">
          <span>
            Pendaftaran Online <br>
          </span>
          <span class="text-2xl">
            Kartu Peserta Mujahadah Kubro <br>
          </span>
          <span>
            Muharram 1446
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class=" px-4 py-2">
    <table class="   w-full">
      <thead>
        <tr class=" border">
          <th class=" border" rowspan="2">Gelombang Acara</th>
          <th class=" border" rowspan="2">Ketua <br> Rombongan</th>
          <th class=" border" rowspan="2">Provinsi <br>Kota / Kabupaten</th>
          <th class=" border" colspan="4">Peserta Mujahadah</th>
          <th class=" border" rowspan="2">Total</th>
        </tr>
        <tr>
          <th class=" border w-16">Bapak</th>
          <th class=" border w-16">Ibu</th>
          <th class=" border w-16">Remaja</th>
          <th class=" border w-16">Kanak2</th>
        </tr>
      </thead>
      <tbody>
        @foreach($grafikPeserta as $peserta)
        <tr class=" hover:bg-green-200 border even:bg-gray-100">

          <td class=" border text-center">
            {{ $peserta->gelombang_acara }}
          </td>
          <td class=" border text-left capitalize px-2">{{ $peserta->nama}}</td>
          <td class=" border text-center">
            {{ $peserta->province_name }} <br>
            {{ $peserta->regency_name }}
          </td>
          <td class=" border text-center">{{ $peserta->jumlah_peserta_bapak }}</td>
          <td class=" border text-center">{{ $peserta->jumlah_peserta_ibu }}</td>
          <td class=" border text-center">{{ $peserta->jumlah_peserta_remaja }}</td>
          <td class=" border text-center">{{ $peserta->jumlah_peserta_kanak }}</td>
          <td class=" border text-center">
            {{ $peserta->jumlah_peserta_kanak +
                   $peserta->jumlah_peserta_remaja +
                   $peserta->jumlah_peserta_ibu  +
                   $peserta->jumlah_peserta_bapak }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>