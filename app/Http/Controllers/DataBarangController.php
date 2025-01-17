<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataBarang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class DataBarangController extends Controller
{
    public function index()
    {
        $data_barang = DataBarang::all();

        return view('pages.data-barang', compact('data_barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255|unique:data_barang',
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:0',
            'stok_barang' => 'required|integer|min:0',
        ]);

        $user = Auth::user();

        DataBarang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'stok' => $request->stok_barang,
            'created_by' => $user->id,
            'updated_by' => null,
        ]);

        return redirect('data-barang')->with('success', 'Data barang berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'harga_barang' => 'required|numeric|min:0',
            'stok_barang' => 'required|integer|min:0',
        ]);

        $barang = DataBarang::findOrFail($id);
        $user = Auth::user();

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga_barang,
            'stok' => $request->stok_barang,
            'updated_by' =>  $user->id,
        ]);

        return redirect()->route('data-barang')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = DataBarang::find($id);

        if ($barang) {
            $barang->delete();
            return redirect()->route('data-barang')->with('success', 'Barang berhasil dihapus.');
        }

        return redirect()->route('data-barang')->with('error', 'Barang tidak ditemukan.');
    }

}
