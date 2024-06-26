<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RombonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia

        for ($i = 0; $i < 50; $i++) { // Sesuaikan jumlah data yang ingin Anda seed
            DB::table('rombongan')->insert([
                'nama' => $faker->name,
                'jumlah_peserta' => $faker->numberBetween(5, 100), // Jumlah peserta antara 5 hingga 100
                'kota_asal' => $faker->city . ', ' . $faker->state, // Kota dan provinsi asal
                'gelombang_acara' => 'Gelombang ' . $faker->randomElement(['I', 'II', 'III', 'IV','V']), // Gelombang acak
                'tampat_acara' => $faker->optional()->city, // Tempat acara, opsional
                'saran' => $faker->optional()->sentence, // Saran, opsional
                'created_at' => now(),
                'updated_at' => now(),
            ]);}
    }
}
