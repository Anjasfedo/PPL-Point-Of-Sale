<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\PembelianProduk;

use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProduk = Produk::all();
        $dataSupplier = Supplier::all();
        $dataPembelian = Pembelian::get();
        $dataPembelianTabel = Pembelian::where('total_item', '>', 0)
        ->where('total_pembelian', '>', 0)
        ->where('diterima', '>', 0)
        ->where('kembalian', '>', 0)
        ->get();


        $dataPembelianProduk = PembelianProduk::with('produk')->latest()->get();

        return view('Pembelian.index', compact('dataProduk', 'dataPembelian', 'dataPembelianTabel', 'dataPembelianProduk', 'dataSupplier'));
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
        $pembelian = new Pembelian;
        $pembelian->total_item = 0;
        $pembelian->total_pembelian = 0;
        $pembelian->diterima = 0;
        $pembelian->kembalian = 0;

        $pembelian->save();

        // Simpan id_pembelian ke dalam session
        session(['id_pembelian' => $pembelian->id_pembelian]);
        return redirect()->route('pembelianproduk.index', [$pembelian->id_pembelian]);
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
        $pembelian = Pembelian::find($id);

        // Mengupdate data pembelian dengan nilai diterima dari formulir
        $pembelian->diterima = $request->input('diterima');
        $pembelian->kembalian = $request->input('kembalian');

        // Simpan perubahan pada data pembelian
        $pembelian->save();

        return redirect()->route('pembelian.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
