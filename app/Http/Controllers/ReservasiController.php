<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservasiController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        return view('reservasi.index', compact('kamars'));
    }

    public function create(Kamar $kamar)
    {
        if ($kamar->status !== 'Tersedia') {
            return redirect()->back()->with('error', 'Kamar tidak tersedia');
        }

        return view('reservasi.create', compact('kamar'));
    }
   
    public function store(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'kamar_id'    => 'required|exists:kamars,id',
            'nama_tamu'   => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
            'check_in'    => 'required|date',
            'check_out'   => 'required|date',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        // Ambil kamar
        $kamar = Kamar::findOrFail($request->kamar_id);
// Parse tanggal dari request
$checkIn  = Carbon::parse($request->check_in);
$checkOut = Carbon::parse($request->check_out);

// Pastikan check-out > check-in
if ($checkOut->lessThanOrEqualTo($checkIn)) {
    return back()->withErrors([
        'check_out' => 'Tanggal check-out harus lebih besar dari check-in.'
    ])->withInput();
}

// Hitung selisih hari
$jumlah_hari = $checkOut->diffInDays($checkIn); // SELALU POSITIF

// Hitung total bayar
$total_bayar = $jumlah_hari * $kamar->harga;

        // Simpan reservasi
        $reservasi = Reservasi::create([
            'kamar_id'     => $kamar->id,
            'nama_tamu'    => $request->nama_tamu,
            'no_hp'        => $request->no_hp,
            'check_in'     => $checkIn->format('Y-m-d'),
            'check_out'    => $checkOut->format('Y-m-d'),
            'jumlah_tamu'  => $request->jumlah_tamu,
            'total_bayar'  => $total_bayar,
            'status'       => 'Booking', // atau sesuai default
        ]);

        return redirect()->route('reservasi.index')
                         ->with('success', 'Reservasi berhasil! Total bayar: Rp ' . number_format($total_bayar, 0, ',', '.'));
    }

    public function riwayat()
    {
        $reservasis = Reservasi::with('kamar')->latest()->get();
        return view('reservasi.riwayat', compact('reservasis'));
    }
    public function updateStatus(Request $request, Reservasi $reservasi)
{
    $request->validate([
        'status_reservasi' => 'required|in:Booking,Check-in,Selesai,Batal',
    ]);

    $reservasi->status_reservasi = $request->status_reservasi;
    $reservasi->save();

    // Update status kamar otomatis
    if (in_array($request->status_reservasi, ['Selesai', 'Batal'])) {
        $reservasi->kamar->status = 'Tersedia';
    } else {
        $reservasi->kamar->status = 'Tidak Tersedia';
    }
    $reservasi->kamar->save();

    return back()->with('success', 'Status reservasi berhasil diperbarui.');
}

}
