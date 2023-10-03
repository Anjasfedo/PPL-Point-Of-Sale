<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProdukImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kategori = Kategori::where('nama_kategori', $row[2])->first(); // Cari id_kategori berdasarkan nama_kategori

        if ($kategori) {
            return new Produk([
                'nama_produk' => $row[1],
                'harga_jual' => $row[3],
                'id_kategori' => $kategori->id_kategori, // Gunakan id_kategori yang sesuai
                'stok' => $row[4],
            ]);
        }

        return null; // Atau lakukan penanganan lain jika tidak ada kategori yang sesuai
    }

    public function startRow(): int
    {
        return 3; // Sesuaikan dengan nomor baris yang berisi data (biasanya baris 2 adalah data, bukan header)
    }
}
