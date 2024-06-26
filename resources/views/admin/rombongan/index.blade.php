<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar surat Masuk') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-2 bg-white border-b border-gray-200">
                    <div class=" grid grid-cols-1 sm:grid-cols-2">
                        <div class="flex py-2">
                            <a href="/tambah-surat-masuk" class=" flex py-1 px-2 text-white  bg-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Surat Masuk
                            </a>
                        </div>
                        <div class=" justify-end  gap-2 w-full">
                            <form action="/surat-masuk" method="GET">
                                <div class=" flex gap-2 py-2">
                                    <input type="text" class=" w-full py-1" name="cari" value="{{ request('cari') }}" placeholder="Masukkan kata kunci">
                                    <button class=" py-1 px-2 bg-blue-600 text-white" type="submit">Surat </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div>
                            @if (!is_null($dataSuratMasuk))
                            @if ($dataSuratMasuk->total() > 0)
                            <p>Hasil pencarian untuk : <strong>{{ request('cari') }}</strong></p>
                            <!-- Tampilkan data surat masuk -->
                            @else
                            <p>Tidak ditemukan hasil untuk : <strong>{{ request('cari') }}</strong></p>
                            @endif
                            @endif

                        </div>
                    </div>
                    <div class=" overflow-auto">
                        <table class="table table-bordered w-full">
                            <thead class=" bg-blue-300">
                                <tr class=" border text-left ">
                                    <th class=" px-2  w-32">No Agenda
                                        <br> kode
                                    </th>
                                    <th class=" px-2 w-1/2">Isi Ringkasan file</th>
                                    <th>Asal <br> Surat</th>

                                    <th class=" px-2 ">
                                        Tanggal Surat <br>
                                        <hr>
                                        No Surat
                                    </th>
                                    <th class=" text-center ">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($dataSuratMasuk->count() != null )
                                @foreach($dataSuratMasuk as $suratMasuk)
                                <tr class=" border even:bg-gray-100 hover:bg-green-200">

                                    <td class=" px-2">
                                        {{ $suratMasuk->no_agenda }}<br>
                                        <hr>
                                        {{ $suratMasuk->kode }}
                                    </td>


                                    <td class=" px-2">
                                        <p class=" ">
                                            {{ strlen($suratMasuk->isi) > 50 ? substr($suratMasuk->isi, 0, 50) : $suratMasuk->isi }}

                                            <br>
                                            <hr>
                                            File {{ $suratMasuk->file }}
                                        </p>

                                    </td>
                                    <td class=" px-2">{{ $suratMasuk->asal_surat }}</td>
                                    <td class=" px-2">
                                        {{ $suratMasuk->tgl_surat }}
                                        <br>
                                        <hr>{{ $suratMasuk->no_surat }}
                                    </td>
                                    <td class=" gap-2 ">
                                        <div class=" justify-center flex gap-1">
                                            <form action="/surat-masuk/{{$suratMasuk->id}}" method="post" id="deleteForm">
                                                @csrf
                                                @method('delete')
                                                <button title="hapus data" type="button" class=" hover:bg-red-800 float-start  py-1 px-1 bg-red-600   text-white rounded-sm" onclick="showAlert()">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                            <button title="hapus data" type="button" class=" flex py-1 px-1 hover:bg-yellow-500 bg-yellow-300    rounded-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>

                                            </button>
                                        </div>


                                        <script>
                                            function showAlert() {
                                                Swal.fire({
                                                    title: 'Apakah Kamu Yakin?',
                                                    text: "data akan terhapus secara permanen!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Yes, delete it!',
                                                    cancelButtonText: 'No, cancel!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('deleteForm').submit();
                                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                                        Swal.fire(
                                                            'Batalkan',
                                                            'File Kamu Aman :)',
                                                            'error'
                                                        )
                                                    }
                                                })
                                            }
                                        </script>

                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class=" border text-center py-2 " colspan="5">
                                        <span> data tidak di temukan</span>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class=" py-2">
                        {{$dataSuratMasuk}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>