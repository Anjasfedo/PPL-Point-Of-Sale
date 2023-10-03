<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supplier;

use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SupplierImport;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSupplier = Supplier::latest()->get();

        return view('supplier.index', compact('dataSupplier'));
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
            'nama_supplier' => 'required|min:5|unique:suppliers',
            'telepon' => 'required|min:1',
        ]);

        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);

        Supplier::create($request->all());

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
            'nama_supplier' => 'required|min:5|unique:suppliers',
            'telepon' => 'required|min:1',
        ]);

        if($validator->fails()) return back()->with('error', 'gagal ditambah')->withInput()->withErrors($validator);


        $dataSupplier = Supplier::find($id);
        $dataSupplier->update($request->all());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datasupplier = Supplier::where('id_supplier',$id)->firstOrFail();
        $datasupplier->delete();

        return back();
    }

    public function supplierImport(Request $request)
    {
        $this->validate($request, [
            'supplier' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SupplierImport, $request->file('supplier')); // Menggunakan kelas supplierImport yang diperbarui

        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }
}
