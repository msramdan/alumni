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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->integer('no_absen');
            $table->integer('no_reg')->unique(); // Menambahkan pembatasan unik
            $table->string('tempat_lahir', 255);
            $table->date('tanggal_lahir');
            $table->string('photo')->nullable();
            $table->foreignId('pelaksaan_diklat_id')->nullable()->constrained('pelaksaan_diklats')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('alumni');
    }
};
