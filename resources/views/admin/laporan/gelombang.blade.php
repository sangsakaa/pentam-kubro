<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Laporab Berdasarkan Gelombang Acara') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="px-4 mx-auto sm:px-4 lg:px-4">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4">
          <div>
          </div>
          <div class=" px-4 py-2">
            <?php
            // Initialize an array to hold the totals for each wave
            $wave_totals = [];

            // Define the correct order of waves
            $wave_order = ['Khodimul', 'Ibu-Ibu', 'Remaja', 'Kanak-Kanak', 'Bapak-Bapak'];

            // Initialize wave totals with zeroes
            foreach ($wave_order as $wave) {
              $wave_totals[$wave] = 0;
            }

            // Iterate through the participants and calculate totals
            foreach ($grafikPeserta as $peserta) {
              $waves = json_decode($peserta['gelombang_acara'], true);
              $total_peserta = $peserta['jumlah_peserta_bapak'] +
                $peserta['jumlah_peserta_ibu'] +
                $peserta['jumlah_peserta_remaja'] +
                $peserta['jumlah_peserta_kanak'];

              foreach ($waves as $wave) {
                if (isset($wave_totals[$wave])) {
                  $wave_totals[$wave] += $total_peserta;
                }
              }
            }
            ?>
            <table class="text-sm w-full">
              <thead>
                <tr class="border">
                  <th class="border">Gelombang Acara</th>
                  <?php foreach ($wave_order as $wave) : ?>
                    <th class="border"><?= $wave ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <tr class="hover:bg-green-200 border even:bg-gray-100">
                  <td class="border text-center">Total Peserta</td>
                  <?php foreach ($wave_order as $wave) : ?>
                    <td class="border text-center"><?= $wave_totals[$wave] ?></td>
                  <?php endforeach; ?>
                </tr>
              </tbody>
            </table>



          </div>
        </div>
      </div>
    </div>
  </div>


</x-app-layout>