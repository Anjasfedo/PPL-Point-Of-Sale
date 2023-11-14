<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanBarang;

use Illuminate\Support\Facades\Validator;

class PenjualanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id)
    {
        $dataBarang = Barang::latest()->get();
        $dataPenjualan = Penjualan::where('id_penjualan', $id)->first(); // Menggunakan first() untuk mengambil satu baris data.
        $dataPenjualanBarang = PenjualanBarang::where('id_penjualan', $id)->get();
        $id_penjualan = $id;

        return view('penjualanBarang.index', compact('dataBarang', 'dataPenjualan', 'dataPenjualanBarang', 'id_penjualan'));
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
            'id_barang' => 'required|array',
            'id_user' => 'required',
            'jumlah' => 'required|array',
            'total_harga' => 'required|array',
            'diterima' => 'required',
        ]);

        foreach ($request->id_barang as $key => $id_barang) {
            $penjualanBarang = new PenjualanBarang();
            $penjualanBarang->id_penjualan = $request->id_penjualan;
            $penjualanBarang->id_barang = $id_barang;
            $penjualanBarang->id_user = $request->id_user;
            $penjualanBarang->jumlah = $request->jumlah[$key];
            $penjualanBarang->total_harga = $request->total_harga[$key];
            $penjualanBarang->save();

            $barang = Barang::find($id_barang);
            $barang->stok -= $request->jumlah[$key];
            $barang->save();
        }

        $total_item = array_sum($request->jumlah);
        $total_penjualan = array_sum($request->total_harga);
        $diterima = $request->diterima;
        $kembalian = $diterima - $total_penjualan;

        $penjualan = Penjualan::find($request->id_penjualan);
        $penjualan->total_item = $total_item;
        $penjualan->total_penjualan = $total_penjualan;
        $penjualan->diterima = $diterima;
        $penjualan->kembalian = $kembalian;
        $penjualan->save();

        return view('PenjualanBarang.nota');
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
