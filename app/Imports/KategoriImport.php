<?php

namespace App\Imports;

use App\Models\Kategori;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KategoriImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {

        return new Kategori([
            'nama_kategori' => $row[1], // Kolom 'name' tetap tidak berubah
        ]);
    }

    public function startRow(): int
    {
        return 3; // Sesuaikan dengan nomor baris yang berisi data (biasanya baris 2 adalah data, bukan header)
    }
}
