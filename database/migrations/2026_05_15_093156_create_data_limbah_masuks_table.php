<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
       Schema::create('data_limbah_masuk', function (Blueprint $table) {
            $table->id('id_limbah_medis');
            $table->unsignedBigInteger('id_data_fasyankes');
            $table->date('tanggal_pengangkutan');
            $table->date('tanggal_penerimaan');
            $table->date('tanggal_batas_penyimpanan');
            $table->string('kode_cust', 10);
            $table->string('no_polisi', 10);
            $table->string('driver', 20);
            $table->integer('kemasan');
            $table->string('satuan', 30);
            $table->decimal('jumlah_limbah', 10, 2);
            $table->enum('status', [
                'pending',
                'diterima',
                'disimpan',
                'dimusnahkan'
            ]);

            $table->timestamps();

            $table->foreign('id_data_fasyankes')
                ->references('id_data_fasyankes')
                ->on('data_fasyankes')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_limbah_masuk');
    }
};
