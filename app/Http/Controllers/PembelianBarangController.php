<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\PembelianBarang;

use Illuminate\Support\Facades\Validator;

class PembelianBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $dataBarang = Barang::latest()->get();
        $dataSupplier = Supplier::latest()->get();
        $dataPembelian = Pembelian::where('id_pembelian', $id)->first();
        $dataPembelianBarang = PembelianBarang::where('id_pembelian', $id)->get();
        $id_pembelian = $id;

        return view('pembelianBarang.index', compact('dataBarang', 'dataSupplier', 'dataPembelian', 'dataPembelianBarang', 'id_pembelian'));
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
            'id_barang' => 'required|array',
            'id_supplier' => 'required',
            'harga_beli' => 'required|array',
            'jumlah' => 'required|array',
            'total_harga' => 'required|array',
            'diterima' => 'required',
        ]);

        foreach ($request->id_barang as $key => $id_barang) {
            $pembelianBarang = new PembelianBarang();
            $pembelianBarang->id_pembelian = $request->id_pembelian;
            $pembelianBarang->id_barang = $id_barang;
            $pembelianBarang->id_supplier = $request->id_supplier;
            $pembelianBarang->harga_beli = $request->harga_beli[$key];
            $pembelianBarang->jumlah = $request->jumlah[$key];
            $pembelianBarang->total_harga = $request->total_harga[$key];
            $pembelianBarang->save();

            $barang = Barang::find($id_barang);
            $barang->stok += $request->jumlah[$key];
            $barang->save();
        }

        $total_item = array_sum($request->jumlah);
        $total_pembelian = array_sum($request->total_harga);
        $diterima = $request->diterima;
        $kembalian = $diterima - $total_pembelian;

        $pembelian = Pembelian::find($request->id_pembelian);
        $pembelian->total_item = $total_item;
        $pembelian->total_pembelian = $total_pembelian;
        $pembelian->diterima = $diterima;
        $pembelian->kembalian = $kembalian;
        $pembelian->save();

        return view('PembelianBarang.nota');
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
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }
}