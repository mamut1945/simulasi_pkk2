<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        return view('kamar.index', compact('kamars'));
    }

    public function create()
    {
        $tipe = Kamar::tipes();
        $statuses = Kamar::statuses();
        return view('kamar.create', compact('tipe', 'statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kamar' => 'required|unique:kamars,no_kamar',
            'tipe' => 'required',
            'harga' => 'required',
            'status' => 'required'
        ]);

        // hapus titik/koma, ubah ke integer
        $harga = str_replace(['.', ','], '', $request->harga);
        $harga = (int) $harga;

        Kamar::create([
            'no_kamar' => $request->no_kamar,
            'tipe' => $request->tipe,
            'harga' => $harga,
            'status' => $request->status
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit(Kamar $kamar)
    {
        $tipe = Kamar::tipes();
        $statuses = Kamar::statuses();
        return view('kamar.edit', compact('tipe', 'statuses', 'kamar'));
    }

    public function update(Request $request, Kamar $kamar)
    {
        $request->validate([
            'no_kamar' => 'required|unique:kamars,no_kamar,' . $kamar->id,
            'tipe' => 'required',
            'harga' => 'required',
            'status' => 'required'
        ]);

        $harga = str_replace(['.', ','], '', $request->harga);
        $harga = (int) $harga;

        $kamar->update([
            'no_kamar' => $request->no_kamar,
            'tipe' => $request->tipe,
            'harga' => $harga,
            'status' => $request->status
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }
}
