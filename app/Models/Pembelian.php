<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelians';
    protected $primaryKey = 'id_pembelian';
    protected $guarded = [];

    protected $fillable = [
        'total_item',
        'total_pembelian',
        'diterima',
        'kembalian',
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'pembelian_produks');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'pembelian_produks');
    }
}
