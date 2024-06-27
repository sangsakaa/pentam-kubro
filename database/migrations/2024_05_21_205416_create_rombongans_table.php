<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRombongansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rombongan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran');
            $table->string('nama')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            $table->integer('jumlah_peserta_remaja')->nullable();
            $table->integer('jumlah_peserta_kanak')->nullable();
            $table->integer('jumlah_peserta_ibu')->nullable();
            $table->integer('jumlah_peserta_bapak')->nullable();
            $table->string('province');
            $table->string('kabupaten');
            $table->string('gelombang_acara')->nullable();
            $table->string('tempat_acara')->nullable();
            $table->string('saran')->nullable();
            $table->string('kendaraan')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rombongan');
    }
}
