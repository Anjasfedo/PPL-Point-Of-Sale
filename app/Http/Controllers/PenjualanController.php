<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Penjualan;
use App\Models\PenjualanProduk;

use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProduk = Produk::all();
        $dataPenjualan = Penjualan::get();
        $dataPenjualanProduk = PenjualanProduk::with('produk')->latest()->get();

        return view('Penjualan.index', compact('dataProduk', 'dataPenjualan', 'dataPenjualanProduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjualan = Penjualan::create([
            'total_item' => 0,
            'total_penjualan' => 0,
            'diterima' => 0,
            'kembalian' => 0,
        ]);
    
        session(['id_penjualan' => $penjualan->id_penjualan]);
    
        return redirect()->route('penjualanproduk.index', [$penjualan->id_penjualan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $request->validate([
            'diterima' => 'required|numeric|min:1',
        ]);

        // Mengambil data penjualan berdasarkan $id
        $penjualan = Penjualan::find($id);

        // Mengupdate data penjualan dengan nilai diterima dari formulir
        $penjualan->diterima = $request->input('diterima');
        $penjualan->kembalian = $request->input('kembalian');

        // Mengambil data penjualan_detail berdasarkan id_penjualan
        $penjualanproduk = PenjualanProduk::where('id_penjualan', $id)->get();

        // Mengurangkan stok produk berdasarkan data penjualan_detail
        foreach ($penjualanproduk as $detail) {
            $produk = Produk::find($detail->id_produk);

            if ($produk) {
                // Mengurangkan stok produk sesuai dengan jumlah penjualan_detail
                $produk->stok -= $detail->jumlah;
                $produk->save();
            }
        }

        // Simpan perubahan pada data penjualan
        $penjualan->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
