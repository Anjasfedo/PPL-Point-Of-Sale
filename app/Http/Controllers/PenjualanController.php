<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\PenjualanBarang;

use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBarang = Barang::all();
        $dataPenjualan = Penjualan::get();
        $dataPenjualanTabel = Penjualan::where('total_item', '>', 0)
            ->where('total_penjualan', '>', 0)
            ->where('diterima', '>', 0)
            ->where('kembalian', '>', 0)
            ->get();

        $dataPenjualanBarang = PenjualanBarang::with('barang')->latest()->get();

        return view('Penjualan.index', compact('dataBarang', 'dataPenjualan', 'dataPenjualanTabel', 'dataPenjualanBarang'));
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
        $penjualan = new Penjualan;
        $penjualan->total_item = 0;
        $penjualan->total_penjualan = 0;
        $penjualan->diterima = 0;
        $penjualan->kembalian = 0;
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);

        return redirect()->route('penjualanbarang.index', [$penjualan->id_penjualan]);
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

    public function notaPenjualan()
    {
        $penjualan = Penjualan::find(session('id_penjualan'));
        if (!$penjualan) {
            abort(404);
        }
        $detail = PenjualanBarang::with('barang')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        return view('penjualan.notaPenjualan', compact('penjualan', 'detail'));
    }
}