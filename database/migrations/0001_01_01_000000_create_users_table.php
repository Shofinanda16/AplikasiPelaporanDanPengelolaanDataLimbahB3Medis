<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {

            $table->id('id_user');
            $table->string('username', 20)->unique();
            $table->string('nama', 50);
            $table->string('password', 8);

            $table->enum('role', [
                'staf',
                'petugas',
                'manager',
                'admin'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};