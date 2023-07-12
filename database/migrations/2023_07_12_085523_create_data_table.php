<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kecamatan_id')->unsigned();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('periode_tahun_id')->unsigned();
            $table->foreign('periode_tahun_id')->references('id')->on('periode_tahuns')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('jumlah_anak');
            $table->bigInteger('jumlah_kasus_pendek');
            $table->bigInteger('jumlah_kasus_sangatpendek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
