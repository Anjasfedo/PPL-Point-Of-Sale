<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanProduk extends Model
{
    use HasFactory;

    protected $table = 'penjualan_produks';
    protected $primaryKey = 'id_penjualan_produk'; 
    protected $guarded = [];

    protected $fillable = [
        'id_penjualan',
        'id_produk',
        'jumlah',
        'total_harga',
    ];

    public function produk()
    {
    return $this->belongsTo(Produk::class, 'id_produk');
    }
}
