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
        Schema::create('data_pangkats', function (Blueprint $table) {
            $table->id();
            $table->text('nip');
            $table->text('jabatan');
            $table->text('gol');
            $table->text('pangkatakhir');
            $table->text('pangkatdatang');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pangkats');
    }
};
