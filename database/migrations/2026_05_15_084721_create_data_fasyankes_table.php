<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_fasyankes', function (Blueprint $table) {
        $table->id('id_data_fasyankes');
        $table->unsignedBigInteger('id_user');
        $table->string('fasyankes', 50);
        $table->string('kode_limbah', 10);
        $table->string('jenis_limbah', 30);
        $table->string('manifest', 10);
        $table->timestamps();
        $table->foreign('id_user')
        ->references('id_user')
        ->on('users')
        ->onDelete('cascade');
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_fasyankes');
    }
};