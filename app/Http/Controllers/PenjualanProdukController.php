<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\PenjualanProduk;

use Illuminate\Support\Facades\Validator;

class PenjualanProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $dataProduk = Produk::latest()->get();
        $dataPenjualan = Penjualan::where('id_penjualan', $id)->first(); // Menggunakan first() untuk mengambil satu baris data.
        $dataPenjualanProduk = PenjualanProduk::where('id_penjualan', $id)->get();
        $id_penjualan = $id;

        return view('penjualanproduk.index', compact('dataProduk', 'dataPenjualan', 'dataPenjualanProduk', 'id_penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id_penjualan)
    {
        $request->validate([
            'id_penjualan' => 'required',
            'id_produk' => 'required|array',
            'id_user' => 'required',
            'jumlah' => 'required|array',
            'total_harga' => 'required|array',
            'diterima' => 'required', // Pastikan diterima adalah required
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan data penjualan_produk ke tabel penjualan_produks
        foreach ($request->id_produk as $key => $id_produk) {
            $penjualanProduk = new PenjualanProduk();
            $penjualanProduk->id_penjualan = $request->id_penjualan;
            $penjualanProduk->id_produk = $id_produk;
            $penjualanProduk->id_user = $request->id_user;
            $penjualanProduk->jumlah = $request->jumlah[$key];
            $penjualanProduk->total_harga = $request->total_harga[$key];
            // Simpan penjualan_produk
            $penjualanProduk->save();

            // Kurangi stok pada tabel produks berdasarkan id_produk
            $produk = Produk::find($id_produk);
            $produk->stok -= $request->jumlah[$key];
            $produk->save();
        }

        // Hitung total_item, total_penjualan, dan kembalian
        $total_item = array_sum($request->jumlah);
        $total_penjualan = array_sum($request->total_harga);
        $diterima = $request->diterima;
        $kembalian = $diterima - $total_penjualan;

        // Simpan data ke tabel penjualan
        $penjualan = Penjualan::find($request->id_penjualan);
        $penjualan->total_item = $total_item;
        $penjualan->total_penjualan = $total_penjualan;
        $penjualan->diterima = $diterima;
        $penjualan->kembalian = $kembalian;
        $penjualan->save();

        return view('PenjualanProduk.nota', compact('id_penjualan'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $dataPenjualan = PenjualanProduk::find($id);

        // // Mendapatkan objek Produk berdasarkan id_produk dari permintaan
        // $produk = Produk::find($request->id_produk);

        // if (!$produk) {
        //     return back()->with('error', 'Produk tidak ditemukan');
        // }

        // // Validasi jumlah tidak kurang dari stok
        // if ($request->jumlah < 0) {
        //     return back()->with('error', 'Jumlah produk tidak valid.');
        // }

        // // Validasi jumlah tidak melebihi stok
        // if ($request->jumlah > $produk->stok) {
        //     return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        // }

        // // Mengurangi stok produk yang sebelumnya ditambahkan
        // $produk->stok += $dataPenjualan->jumlah;
        // $produk->save();

        // // Update jumlah
        // $dataPenjualan->jumlah = $request->jumlah;

        // // Mengakses harga_jual dari objek Produk
        // $harga_jual = $produk->harga_jual;

        // // Menghitung ulang total_harga
        // $dataPenjualan->total_harga = $harga_jual * $request->jumlah;

        // // Simpan perubahan
        // $dataPenjualan->save();

        // // Mengurangi stok produk yang baru ditambahkan
        // $produk->stok -= $request->jumlah;
        // $produk->save();

        // // Menghitung ulang total item dan total harga untuk penjualan
        // $totalItem = PenjualanProduk::where('id_penjualan', $dataPenjualan->id_penjualan)->sum('jumlah');
        // $totalPenjualan = PenjualanProduk::where('id_penjualan', $dataPenjualan->id_penjualan)->sum('total_harga');

        // // Update data penjualan
        // $penjualan = Penjualan::find($dataPenjualan->id_penjualan);

        // if (!$penjualan) {
        //     return back()->with('error', 'Data penjualan tidak ditemukan');
        // }

        // $penjualan->total_item = $totalItem;
        // $penjualan->total_penjualan = $totalPenjualan;

        // // Simpan perubahan
        // $penjualan->save();

        // return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // // Temukan objek PenjualanProduk berdasarkan ID
        // $penjualanProduk = PenjualanProduk::findOrFail($id);

        // // Temukan objek Penjualan berdasarkan id_penjualan pada PenjualanProduk
        // $penjualan = Penjualan::find($penjualanProduk->id_penjualan);

        // // Mengurangkan total_item dengan jumlah yang dihapus
        // $penjualan->total_item -= $penjualanProduk->jumlah;

        // // Mengurangkan total_penjualan dengan total_harga dari PenjualanProduk yang dihapus
        // $penjualan->total_penjualan -= $penjualanProduk->total_harga;

        // // Jika total_item menjadi 0, Anda dapat mengosongkan total_penjualan
        // if ($penjualan->total_item === 0) {
        //     $penjualan->total_penjualan = 0;
        // }

        // // Simpan perubahan pada objek penjualan
        // $penjualan->save();

        // // Mengembalikan jumlah produk yang dihapus ke stok
        // $produk = Produk::find($penjualanProduk->id_produk);
        // $produk->stok += $penjualanProduk->jumlah;
        // $produk->save();

        // // Hapus objek PenjualanProduk
        // $penjualanProduk->delete();

        // return back();
    }
}
