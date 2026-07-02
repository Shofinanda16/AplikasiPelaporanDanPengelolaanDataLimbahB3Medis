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
        Schema::create('data_hasil_insinerasi', function (Blueprint $table) {
            $table->id('id_hasil_insinerasi');
            $table->unsignedBigInteger('id_data_fasyankes');
            $table->unsignedBigInteger('id_limbah_medis');
            $table->date('tanggal_pemusnahan');
            $table->timestamps();
            $table->foreign('id_data_fasyankes')
                ->references('id_data_fasyankes')
                ->on('data_fasyankes')
                ->onDelete('cascade');

            $table->foreign('id_limbah_medis')
                ->references('id_limbah_medis')
                ->on('data_limbah_masuk')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_hasil_insinerasi');
    }
};