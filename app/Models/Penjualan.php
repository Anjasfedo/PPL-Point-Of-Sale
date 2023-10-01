<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $primaryKey = 'id_penjualan';
    protected $guarded = [];

    protected $fillable = [
        'total_item',
        'total_penjualan',
        'diterima',
        'kembalian',
    ];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'penjualan_produks');
    }
}
