<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kategori;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KategoriExport;
use App\Imports\KategoriImport;

use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataKategori = Kategori::latest()->get();

        return view('kategori.index', compact('dataKategori'));
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
            'nama_kategori' => 'required|min:5|unique:kategoris',

        ]);

        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);

        $dataKategori['nama_kategori'] = $request->nama_kategori;
        Kategori::create($dataKategori);

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
            'nama_kategori' => 'required|min:5|unique:kategoris',

        ]);

        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);

        $dataKategori['nama_kategori'] = $request->nama_kategori;
        Kategori::find($id)->update($dataKategori);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKategori = Kategori::find($id);

        if($dataKategori){
            $dataKategori->delete();
        }

        return back();
    }

    public function kategoriImport(Request $request)
    {
        $this->validate($request, [
            'kategori' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new KategoriImport, $request->file('kategori')); // Menggunakan kelas KategoriImport yang diperbarui

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

    // public function kategoriExport()
    // {
    //     $dataKategori = Kategori::select('nama_kategori')->get(); // Hanya mengambil kolom 'name'

    //     return Excel::download(new KategoriExport($dataKategori), 'kategori.xlsx');
    // }
}
