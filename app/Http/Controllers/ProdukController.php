<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Kategori;

use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataProduk = Produk::latest()->get();

        $dataKategori = Kategori::all();

        return view('produk.index', compact('dataProduk', 'dataKategori'));
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

        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required|min:5|unique:produks',
            'harga_jual' => 'required|min:1',
            'stok' => 'required',
            'id_kategori' => 'required',
        ]);
        
        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);

        // Produk::latest()->first() ?? new Produk();
        Produk::create($request->all());
        
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
        $validator = Validator::make($request->all(),[
            'nama_produk' => 'required|min:5|',
            'harga_jual' => 'required|min:1',
            'stok' => 'required',
        ]);
        
        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);
        

        $dataProduk = Produk::find($id);
        $dataProduk->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataProduk = Produk::where('id_produk',$id)->firstOrFail();
        $dataProduk->delete();

        return back();
    }
}
