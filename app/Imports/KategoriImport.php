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
            'nama_kategori' => $row[1],
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
