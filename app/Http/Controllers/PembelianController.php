<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\PembelianBarang;

use Illuminate\Support\Facades\Validator;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBarang = Barang::all();
        $dataSupplier = Supplier::all();
        $dataPembelian = Pembelian::get();
        $dataPembelianTabel = Pembelian::where('total_item', '>', 0)
            ->where('total_pembelian', '>', 0)
            ->where('diterima', '>', 0)
            ->where('kembalian', '>', 0)
            ->get();

        $dataPembelianBarang = PembelianBarang::with('barang')->latest()->get();

        return view('Pembelian.index', compact('dataBarang', 'dataPembelian', 'dataPembelianTabel', 'dataPembelianBarang', 'dataSupplier'));
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
        $pembelian = new Pembelian;
        $pembelian->total_item = 0;
        $pembelian->total_pembelian = 0;
        $pembelian->diterima = 0;
        $pembelian->kembalian = 0;

        $pembelian->save();

        session(['id_pembelian' => $pembelian->id_pembelian]);
        return redirect()->route('pembelianbarang.index', [$pembelian->id_pembelian]);
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

    public function notaPembelian()
    {
        $pembelian = Pembelian::find(session('id_pembelian'));
        if (!$pembelian) {
            abort(404);
        }
        $detail = PembelianBarang::with('barang')
            ->where('id_pembelian', session('id_pembelian'))
            ->get();

        return view('pembelian.notaPembelian', compact('pembelian', 'detail'));
    }
}