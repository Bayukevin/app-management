<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\DataBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $dataBarang = DataBarang::all();
        $barangKeluar = BarangKeluar::with('dataBarang')->get();
        return view('pages.barang-keluar', compact('dataBarang','barangKeluar'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'data_barang_id' => 'required|exists:data_barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        $barangKeluar->update([
            'data_barang_id' => $request->data_barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil diperbarui.');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'data_barang_id' => 'required|exists:data_barang,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $barangKeluar = BarangKeluar::create([
            'data_barang_id' => $request->data_barang_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'created_by' => Auth::id(),
            'updated_by' => null,
        ]);

        $barang = DataBarang::findOrFail($request->data_barang_id);
        if ($barang->stok >= $request->jumlah) {
            $barang->stok -= $request->jumlah;
            $barang->updated_by = Auth::id();
            $barang->save();
        } else {
            return redirect()->back()->with('error', 'Stok barang tidak cukup.');
        }

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = $barangKeluar->dataBarang;

        $barang->stok += $barangKeluar->jumlah;

        $barang->updated_by = Auth::id();

        $barang->save();

        $barangKeluar->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dihapus dan stok barang dikembalikan.');
    }


}
