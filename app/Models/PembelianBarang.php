<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    use HasFactory;

    protected $table = 'pembelian_barangs';
    protected $primaryKey = 'id_pembelian_barang';
    protected $guarded = [];

    protected $fillable = [
        'id_pembelian',
        'id_barang',
        'id_supplier',
        'jumlah',
        'harga_beli',
        'total_harga',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }
}
