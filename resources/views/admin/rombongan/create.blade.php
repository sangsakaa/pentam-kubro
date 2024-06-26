<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah surat Masuk') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                    <div>
                        <span class=" bg-blue-600 px-2 py-2 text-white rounded-md">
                            <a href="/surat-masuk">Surat Masuk</a>
                        </span>
                    </div>
                    <div class=" justify-end grid">
                        <!-- <label class="capitalize" for="type_surat">Jenis Surat</label> -->
                        <select name="type_surat" id="type_surat" class=" py-1">
                            <option value="">-- pilih jenis surat --</option>
                            <option value="internal">Internal</option>
                            <option value="external">External</option>
                            <option value="special">Special</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="" method="post">
                        <div class=" sm:grid grid grid-cols-1 gap-2 sm:grid-cols-2  ">
                            <div class=" grid grid-cols-1">
                                <label class=" capitalize" for="">nomor agenda</label>
                                <input class=" py-1 " type="text" name="id_surat">
                                <label class=" capitalize" for="">asal surat</label>
                                <input class=" py-1 " type="text" name="id_surat">
                                <label class=" capitalize" for="">nomor surat</label>
                                <input class=" py-1 " type="text" name="id_surat">
                                <label class=" capitalize" for="">isi ringkasan</label>
                                <input class=" py-1 " type="text" name="id_surat">
                            </div>
                            <div class=" grid-cols-1">
                                <script>
                                    document.getElementById('type_surat').addEventListener('change', function() {
                                        var selectedOption = this.value;
                                        if (selectedOption === 'internal') {
                                            document.getElementById('klasifikasi_internal').style.display = 'block';
                                            document.getElementById('klasifikasi_external').style.display = 'none';
                                            document.getElementById('klasifikasi_special').style.display = 'none';
                                        } else if (selectedOption === 'external') {
                                            document.getElementById('klasifikasi_internal').style.display = 'none';
                                            document.getElementById('klasifikasi_external').style.display = 'block';
                                            document.getElementById('klasifikasi_special').style.display = 'none';
                                        } else if (selectedOption === 'special') {
                                            document.getElementById('klasifikasi_internal').style.display = 'none';
                                            document.getElementById('klasifikasi_external').style.display = 'none';
                                            document.getElementById('klasifikasi_special').style.display = 'block';
                                        }
                                    });
                                </script>
                                <div class=" grid grid-cols-2 gap-2">
                                    <div class=" w-full">
                                        <label class=" capitalize" for="">index berkas</label>
                                        <input type="text" class=" py-1 w-full" name="id_surat">
                                    </div>
                                    <div>
                                        <label class=" capitalize" for="">tanggal surat</label>
                                        <input type="date" class=" py-1 w-full" name="id_surat">
                                    </div>
                                </div>
                                <label class=" capitalize" for="">ungah berkas</label>
                                <input type="file" class=" py-1 w-full" name="id_surat">

                                <div class=" grid grid-cols-1">
                                    <div id="klasifikasi_internal" style="display: none;">
                                        <label class="capitalize" for="id_surat">Kode Klasifikasi</label> <br>
                                        <select class=" py-1 w-full" name="id_surat" id="id_surat">
                                            <option value=""> -- Pilih Kode Klasifikasi -- </option>
                                            @if(isset($klasifikasi) && count($klasifikasi) > 0)
                                            @foreach($klasifikasi as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->nama }}</option>
                                            @endforeach
                                            @else
                                            <option value="">Tidak ada klasifikasi tersedia</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div id="klasifikasi_special" style="display: none;">
                                        <label class="capitalize" for="special_code">Kode Klasifikasi Khusus</label>
                                        <input class=" py-1 w-full" name="special_code" id="special_code" placeholder="Masukkan Kode Klasifikasi Khusus"></input>
                                    </div>
                                    <div id="klasifikasi_external" style="display: none;">
                                        <label class="capitalize" for="kode_klasifikasi">Kode Klasifikasi</label> <br>
                                        <input class=" py-1 w-full" type="text" name="kode_klasifikasi" id="kode_klasifikasi" placeholder="Masukkan Kode Klasifikasi">
                                    </div>
                                </div>
                                <div class=" ">
                                    <label class=" capitalize" for="">
                                        <span class=" text-red-700 text-xs">cek sebelum melakukan penyimpanan</span>
                                    </label> <br>
                                    <button class=" bg-blue-600 px-2 py-1 text-white">simpan</button>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>