<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'suppliers';
    protected $primaryKey = 'id_supplier'; 
    protected $guarded = [];

    protected $fillable = [
        'nama_supplier',
        'telepon',
    ];

    public function pembelian()
    {
        return $this->belongsToMany(Pembelian::class, 'pembelian_produks');
    }
}
