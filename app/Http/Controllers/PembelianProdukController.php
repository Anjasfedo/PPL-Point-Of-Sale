<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\PembelianProduk;

use Illuminate\Support\Facades\Validator;

class PembelianProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $dataProduk = Produk::latest()->get();
        $dataSupplier = Supplier::latest()->get();
        $dataPembelian = Pembelian::where('id_pembelian', $id)->first(); // Menggunakan first() untuk mengambil satu baris data.
        $dataPembelianProduk = PembelianProduk::where('id_pembelian', $id)->get();
        $id_pembelian = $id;

        return view('pembelianproduk.index', compact('dataProduk', 'dataSupplier', 'dataPembelian', 'dataPembelianProduk', 'id_pembelian'));
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
    public function store(Request $request, string $id_pembelian)
    {
        $request->validate([
            'id_pembelian' => 'required',
            'id_produk' => 'required|array',
            'id_supplier' => 'required',
            'harga_beli' => 'required|array',
            'jumlah' => 'required|array',
            'total_harga' => 'required|array',
            'diterima' => 'required', // Pastikan diterima adalah required
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        // Simpan data pembelian produk ke tabel pembelian_produks
        foreach ($request->id_produk as $key => $id_produk) {
            $pembelianProduk = new PembelianProduk();
            $pembelianProduk->id_pembelian = $request->id_pembelian;
            $pembelianProduk->id_produk = $id_produk;
            $pembelianProduk->id_supplier = $request->id_supplier;
            $pembelianProduk->harga_beli = $request->harga_beli[$key];
            $pembelianProduk->jumlah = $request->jumlah[$key];
            $pembelianProduk->total_harga = $request->total_harga[$key];
            // Simpan pembelian_produk
            $pembelianProduk->save();
    
            // tambah stok pada tabel produks berdasarkan id_produk
            $produk = Produk::find($id_produk);
            $produk->stok += $request->jumlah[$key];
            $produk->save();
        }
    
        // Hitung total_item, total_pembelian, dan kembalian
        $total_item = array_sum($request->jumlah);
        $total_pembelian = array_sum($request->total_harga);
        $diterima = $request->diterima;
        $kembalian = $diterima - $total_pembelian;
    
        // Simpan data ke tabel pembelian
        $pembelian = Pembelian::find($request->id_pembelian);
        $pembelian->total_item = $total_item;
        $pembelian->total_pembelian = $total_pembelian;
        $pembelian->diterima = $diterima;
        $pembelian->kembalian = $kembalian;
        $pembelian->save();
    
        return redirect()->route('pembelian.index')
            ->with('success', 'Pembelian berhasil disimpan.');
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataPembelian = PembelianProduk::find($id);

        // Mendapatkan objek Produk berdasarkan id_produk dari permintaan
        $produk = Produk::find($request->id_produk);

        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        // Validasi jumlah tidak kurang dari stok
        if ($request->jumlah < 0) {
            return back()->with('error', 'Jumlah produk tidak valid.');
        }

        // Validasi jumlah tidak melebihi stok
        if ($request->jumlah > $produk->stok) {
            return back()->with('error', 'Jumlah produk melebihi stok yang tersedia.');
        }

        // Mengurangi stok produk yang sebelumnya ditambahkan
        $produk->stok -= $dataPembelian->jumlah;
        $produk->save();

        // Update jumlah
        $dataPembelian->jumlah = $request->jumlah;

        // Mengakses harga_jual dari objek Produk
        $harga_beli = $dataPembelian->harga_beli;

        // Menghitung ulang total_harga
        $dataPembelian->total_harga = $harga_beli * $request->jumlah;

        // Simpan perubahan
        $dataPembelian->save();

        // Mengurangi stok produk yang baru ditambahkan
        $produk->stok += $request->jumlah;
        $produk->save();

        // Menghitung ulang total item dan total harga untuk pembelian
        $totalItem = pembelianProduk::where('id_pembelian', $dataPembelian->id_pembelian)->sum('jumlah');
        $totalpembelian = pembelianProduk::where('id_pembelian', $dataPembelian->id_pembelian)->sum('total_harga');

        // Update data pembelian
        $pembelian = pembelian::find($dataPembelian->id_pembelian);

        if (!$pembelian) {
            return back()->with('error', 'Data pembelian tidak ditemukan');
        }

        $pembelian->total_item = $totalItem;
        $pembelian->total_pembelian = $totalpembelian;

        // Simpan perubahan
        $pembelian->save();

        return back();     
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan objek PenjualanProduk berdasarkan ID
        $pembelianProduk = PembelianProduk::findOrFail($id);

        // Temukan objek pembelian berdasarkan id_pembelian pada pembelianProduk
        $pembelian = Pembelian::find($pembelianProduk->id_pembelian);
    
        // Mengurangkan total_item dengan jumlah yang dihapus
        $pembelian->total_item += $pembelianProduk->jumlah;
    
        // Mengurangkan total_pembelian dengan total_harga dari pembelianProduk yang dihapus
        $pembelian->total_pembelian += $pembelianProduk->total_harga;
    
        // Jika total_item menjadi 0, Anda dapat mengosongkan total_pembelian
        if ($pembelian->total_item === 0) {
            $pembelian->total_pembelian = 0;
        }
    
        // Simpan perubahan pada objek pembelian
        $pembelian->save();
    
        // Mengembalikan jumlah produk yang dihapus ke stok
        $produk = Produk::find($pembelianProduk->id_produk);
        $produk->stok -= $pembelianProduk->jumlah;
        $produk->save();
    
        // Hapus objek pembelianProduk
        $pembelianProduk->delete();
    
        return back();
    }
}
