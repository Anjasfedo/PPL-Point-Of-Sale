<?php

namespace App\Imports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SupplierImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {
        return new Supplier([
            'nama_supplier' => $row[1],
            'telepon' => $row[2],
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }
}
