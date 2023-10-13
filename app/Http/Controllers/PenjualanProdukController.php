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
        $dataPenjualan = Penjualan::where('id_penjualan', $id)->first();
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
    public function store(Request $request)
    {
        $id_penjualan = $request->input('id_penjualan');
        $penjualan = Penjualan::find($id_penjualan);
    
        $produk = $request->input('id_produk', []);
        $jumlah = $request->input('jumlah', []);
        $total_harga = $request->input('total_harga', []);
    
        // Loop through the products and create PenjualanProduk records
        for ($product = 0; $product < count($produk); $product++) {
            if (!empty($produk[$product])) {
                PenjualanProduk::create([
                    'id_penjualan' => $id_penjualan,
                    'id_produk' => $produk[$product],
                    'id_user' => auth()->user()->id, // Assuming you want to store the user ID.
                    'jumlah' => $jumlah[$product],
                    'total_harga' => $total_harga[$product],
                ]);
            }
        }
    
        // Update the Penjualan model with additional attributes
        $penjualan->update([
            'diterima' => $request->input('diterima'),
            'total_penjualan' => $request->input('total_penjualan'),
            'kembalian' => $request->input('kembalian'),
            'total_item' => $request->input('total_item'),
        ]);
    
        return back();
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
