<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\Kategori;

use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BarangImport;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataBarang = Barang::latest()->get();

        $dataKategori = Kategori::all();

        return view('barang.index', compact('dataBarang', 'dataKategori'));
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
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|min:5|unique:barangs',
            'harga_jual' => 'required|min:1',
            'stok' => 'required',
            'id_kategori' => 'required',
        ]);

        if ($validator->fails())
            return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);

        Barang::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil ditambah.');
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
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|min:5|',
            'harga_jual' => 'required|min:1',
            'stok' => 'required',
        ]);

        if ($validator->fails())
            return back()->with('error', 'gagal diubah')->withInput()->withErrors($validator);

        $dataBarang = Barang::find($id);
        $dataBarang->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBarang = Barang::where('id_barang', $id)->firstOrFail();
        $dataBarang->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function barangImport(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'barang' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails())
            return back()->with('error', 'gagal diunggah')->withInput()->withErrors($validator);

        try {
            Excel::import(new BarangImport, $request->file('barang'));
            return redirect()->back()->with('success', 'Data berhasil diimpor.');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Data gagal diimpor.');
        }
    }
}
