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
        Schema::table('pembelian_produks', function (Blueprint $table) {
            $table->foreign('id_pembelian')
            ->references('id_pembelian')
            ->on('pembelians')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->foreign('id_produk')
            ->references('id_produk')
            ->on('produks')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->foreign('id_supplier')
            ->references('id_supplier')
            ->on('suppliers')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tabel_pembelian_produks', function (Blueprint $table) {
            //
        });
    }
};
