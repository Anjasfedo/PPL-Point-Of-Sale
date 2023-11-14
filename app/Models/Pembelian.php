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

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'pembelian_barangs');
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'pembelian_barangs');
    }
}
