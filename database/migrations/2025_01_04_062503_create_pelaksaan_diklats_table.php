<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelaksaan_diklats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diklat_id')->nullable()->nullable()->constrained('diklats')->cascadeOnUpdate()->nullOnDelete();
            $table->string('judul_diklat', 255);
			$table->string('angkatan', 100);
			$table->date('tanggal_mulai');
			$table->date('tanggal_selesai');
			$table->string('kota', 255);
			$table->string('provinsi', 255);
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
        Schema::dropIfExists('pelaksaan_diklats');
    }
};
