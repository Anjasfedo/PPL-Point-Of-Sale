<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'produks';
    protected $primaryKey = 'id_produk'; 
    protected $guarded = [];

    protected $fillable = [
        'nama_produk',
        'harga_jual',
        'stok',
        'id_kategori',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function penjualan()
    {
        return $this->belongsToMany(Penjualan::class, 'penjualan_produks');
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'pembelian_produks');
    }
}
