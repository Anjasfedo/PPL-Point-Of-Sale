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
        Schema::table('penjualan_produks', function (Blueprint $table) {
            $table->foreign('id_penjualan')
            ->references('id_penjualan')
            ->on('penjualans')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->foreign('id_produk')
            ->references('id_produk')
            ->on('produks')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_penjualan_produks', function (Blueprint $table) {
            //
        });
    }
};
