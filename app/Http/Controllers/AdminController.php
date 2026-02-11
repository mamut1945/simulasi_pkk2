<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Reservasi;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total kamar
        $totalKamar = Kamar::count();
        $totalKamarTersedia = Kamar::where('status', 'Tersedia')->count();
        $totalKamarTidakTersedia = Kamar::where('status', 'Tidak Tersedia')->count();

        // Total reservasi
        $totalReservasi = Reservasi::count();
        $totalBooking = Reservasi::where('status_reservasi', 'Booking')->count();
        $totalCheckin = Reservasi::where('status_reservasi', 'Check-in')->count();
        $totalSelesai = Reservasi::where('status_reservasi', 'Selesai')->count();
        $totalBatal = Reservasi::where('status_reservasi', 'Batal')->count();

        return view('dashboard', compact(
            'totalKamar', 
            'totalKamarTersedia', 
            'totalKamarTidakTersedia', 
            'totalReservasi', 
            'totalBooking', 
            'totalCheckin', 
            'totalSelesai', 
            'totalBatal'
        ));
    }
}
