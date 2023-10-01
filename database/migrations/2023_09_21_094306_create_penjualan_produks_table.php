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
        Schema::create('penjualan_produks', function (Blueprint $table) {
            $table->increments('id_penjualan_produk');
            $table->unsignedInteger('id_penjualan');
            $table->unsignedInteger('id_produk');
            $table->unsignedInteger('id_user');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_produks');
    }
};
