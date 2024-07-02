<div>
  <div>
    <style>
      #container {
        display: flex;
        align-items: center;
      }

      #logo {
        margin-right: 20px;
        text-align: center;
        /* Adjust this value to control the space between logo and title */
      }

      #tittle {
        display: flex;
        flex-direction: column;
      }

      #tittle span {
        text-align: left;
      }

      .h1 {
        background-color: rgba(7, 75, 36, 255);
        color: white;
      }

      .kop {
        width: 100%;
        margin-top: 10px;
      }

      td {
        border: 1px solid #ddd;
        text-align: center;
        /* Center text in table cell */
        vertical-align: middle;
        /* Center vertically */
      }

      .center-img {
        display: block;
        margin-left: auto;
        margin-right: auto;
      }

      .nama_cap {
        font-size: 20px;
        font-weight: bold;
        text-transform: capitalize;


      }

      table {
        width: 100%;
        border: solid 1px;

      }

      td {
        border: solid 1px;
      }

      h1 {
        text-transform: capitalize;
        text-align: center;
      }
    </style>
    <table class=" kop">
      <tr class="h1 ">
        <td class="logo">
          <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" height="80px" width="80px" alt="Example Image">
        </td>
        <td>
          <span class=" kop-1">
            Yayasan Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo <br>
            PANITIA PELAKSANA MUJAHADAH KUBRO <br>
            MUHARRAM 1446 H
          </span>
        </td>
      </tr>
    </table>
  </div>
  <div class="info-container">
    <div class="info-item"> </div>
    <div class="info-item"></div>
    <div class="info-item"></div>
    <div class="info-item"></div>
    <style>
      .td-left {
        text-align: left;
        border: none;
      }
    </style>
    <hr>
    <table class="td-left">
      <tr>
        <td class="td-left">Ketua Rombongan</td>
        <td class="td-left">: {{$grafikPeserta->first()->nama}}</td>
        <td class="td-left">Provinsi </td>
        <td class="td-left">: {{$grafikPeserta->first()->province_name}}</td>
      </tr>
      <tr>
        <td class="td-left">Kabupaten</td>
        <td class="td-left">: {{$grafikPeserta->first()->regency_name}}</td>
        <td class="td-left">Kecamatan </td>
        <td class="td-left">: {{$grafikPeserta->first()->district_name}}</td>
      </tr>
      <tr>
        <td class="td-left">Jenis Tempat Tinggal </td>
        <td class="td-left">: {{$grafikPeserta->first()->jenis_lokasi}}</td>
        <td class="td-left">Nama Lokasi</td>
        <td class="td-left">: {{$grafikPeserta->first()->nama_lokasi}}</td>

      </tr>
    </table>
  </div>
  <hr>
  <div class=" px-4">
    @php
    use Carbon\Carbon;
    Carbon::setLocale('id');
    @endphp


    <table class=" kop   w-full">
      <thead>
        <tr class=" border">
          <td class=" border" rowspan="2">Kendaraan</td>
          <td class=" border" rowspan="2">
            Tgl Datang <br>
            Tgl Pulang
          </td>
          <td class=" border" colspan="4">Peserta Mujahadah</td>
          <td class=" border" rowspan="2">Total</td>
          <td class=" border" rowspan="2">Biaya</td>
        </tr>
        <tr>
          <td class=" border w-16">Bapak</td>
          <td class=" border w-16">Ibu</td>
          <td class=" border w-16">Remaja</td>
          <td class=" border w-16">Kanak2</td>
        </tr>
      </thead>
      <tbody>
        @foreach($grafikPeserta as $peserta)
        <tr class=" hover:bg-green-200 border even:bg-gray-100">
          <td class=" border text-center">{{ $peserta->kendaraan }}</td>
          <td class="border text-center">
            Datang : {{ \Carbon\Carbon::parse($peserta->tanggal_berangkat)->isoFormat('dddd, DD-MM-YYYY') }} <br>

            Pulang : {{ \Carbon\Carbon::parse($peserta->tanggal_pulang)->isoFormat('dddd, DD-MM-YYYY') }}
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
          <td class=" border text-center">{{ $peserta->biaya }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>