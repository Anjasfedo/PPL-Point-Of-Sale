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
        $dataPenjualanTabel = Penjualan::where('total_item', '>', 0)
        ->where('total_penjualan', '>', 0)
        ->where('diterima', '>', 0)
        ->where('kembalian', '>', 0)
        ->get();

        $dataPenjualanProduk = PenjualanProduk::with('produk')->latest()->get();
        // $dataPenjualanProduk = PenjualanProduk::with('produk')->latest()->get();

        return view('Penjualan.index', compact('dataProduk', 'dataPenjualan' , 'dataPenjualanTabel', 'dataPenjualanProduk'));
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
    public function store(Request $request)
    {
        // Inisialisasi data dengan nilai 0
        $penjualan = new Penjualan;
        $penjualan->total_item = 0;
        $penjualan->total_penjualan = 0;
        $penjualan->diterima = 0;
        $penjualan->kembalian = 0;
        $penjualan->save();

        // Simpan id_penjualan ke dalam session
        session(['id_penjualan' => $penjualan->id_penjualan]);

        return redirect()->route('penjualanproduk.index', [$penjualan->id_penjualan]);
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

        // Simpan perubahan pada data penjualan
        $penjualan->save();

        return redirect()->route('penjualan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
