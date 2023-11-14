<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BarangImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kategori = Kategori::where('nama_kategori', $row[2])->first();

        if ($kategori) {
            return new Barang([
                'nama_barang' => $row[1],
                'harga_jual' => $row[3],
                'id_kategori' => $kategori->id_kategori,
                'stok' => $row[4],
            ]);
        }

        return null;
    }

    public function startRow(): int
    {
        return 3;
    }
}
