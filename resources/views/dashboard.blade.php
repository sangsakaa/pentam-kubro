<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12">
                    <form action="/rombongan-kubro/kabupaten" method="post">
                        @csrf
                        <h1>Form Pendaftaran Calon Peserta Kubro</h1>
                        <div class=" grid grid-cols-1 gap-2 py-2">
                            <input type="text" name="nama" placeholder=" nama ketua rombongan">
                            <input type="text" name="jumlah_peserta" placeholder=" jumlah_peserta">
                            <select id="provinsi" name="province">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province['code'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            <select id="kabupaten" name="kabupaten" disabled>
                                <option value="">Pilih Kabupaten</option>
                            </select>
                            <select name="gelombang_acara" id="">
                                <option value="">Pilih Gelombang Acara</option>
                                <option value="Khodimul">Gelombang 1 Khodimul</option>
                                <option value="Ibu-Ibu">Gelombang 2 Ibu-Ibu</option>
                                <option value="Remaja">Gelombang 3 Remaja</option>
                                <option value="Kanak-Kanak">Gelombang 4 Kanak-Kanak</option>
                                <option value="Bapak-Bapak">Gelombang 5 Bapak-Bapak</option>
                            </select>
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