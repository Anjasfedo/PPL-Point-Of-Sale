<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianProduk extends Model
{
    use HasFactory;

    protected $table = 'pembelian_produks';
    protected $primaryKey = 'id_pembelian_produk'; 
    protected $guarded = [];

    protected $fillable = [
        'id_penjualan',
        'id_produk',
        'id_supplier',
        'jumlah',
        'total_harga',
    ];

    public function produk()
    {
    return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function supplier()
    {
    return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
