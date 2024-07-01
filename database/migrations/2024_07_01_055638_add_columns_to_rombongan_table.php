<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRombonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rombongan', function (Blueprint $table) {
            $table->string('kecamatan')->nullable()->after('kabupaten');
            $table->date('tanggal_pulang')->nullable()->after('kecamatan');
            $table->string('jenis_lokasi')->nullable()->after('tanggal_pulang');
            $table->string('nama_lokasi')->nullable()->after('jenis_lokasi');
            $table->decimal('biaya', 10, 2)->nullable()->after('nama_lokasi');
            $table->string('no_hp_ketua')->nullable()->after('biaya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rombongan', function (Blueprint $table) {
            $table->dropColumn('kecamatan');
            $table->dropColumn('tanggal_pulang');
            $table->dropColumn('jenis_lokasi');
            $table->dropColumn('nama_lokasi');
            $table->dropColumn('biaya');
            $table->dropColumn('no_hp_ketua');
        });
    }
}
