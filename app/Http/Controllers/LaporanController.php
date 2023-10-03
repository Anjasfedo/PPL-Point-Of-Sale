<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pembelian;
use App\Models\Penjualan;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal', now()->toDateString());
        $tanggalAkhir = $request->input('tanggal_akhir', now()->toDateString());

        $penjualanData = Penjualan::whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->get();

        $pembelianData = Pembelian::whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->get();

        $tanggalRange = \Carbon\CarbonPeriod::create($tanggalAwal, $tanggalAkhir);

        $result = [];

        foreach ($tanggalRange as $tanggal) {
            $tanggalString = $tanggal->format('Y-m-d');
            $penjualanItems = $penjualanData->where('created_at', '>=', $tanggalString . ' 00:00:00')
                ->where('created_at', '<=', $tanggalString . ' 23:59:59');
            $pembelianItems = $pembelianData->where('created_at', '>=', $tanggalString . ' 00:00:00')
                ->where('created_at', '<=', $tanggalString . ' 23:59:59');

            $result[] = [
                'tanggal' => $tanggalString,
                'total_penjualan_barang' => $penjualanItems->sum('total_item'),
                'pemasukan' => $penjualanItems->sum('total_penjualan'),
                'total_pembelian_stok_barang' => $pembelianItems->sum('total_item'),
                'pengeluaran' => $pembelianItems->sum('total_pembelian'),
                'pendapatan' => $penjualanItems->sum('total_penjualan') - $pembelianItems->sum('total_pembelian'),
            ];
        }

        return view('Laporan.index', compact('result'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($tanggal)
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
