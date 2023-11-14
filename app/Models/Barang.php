<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'barangs';
    protected $primaryKey = 'id_barang';
    protected $guarded = [];

    protected $fillable = [
        'nama_barang',
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
        return $this->belongsToMany(Penjualan::class, 'penjualan_barangs');
    }

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'pembelian_barangs');
    }
}
