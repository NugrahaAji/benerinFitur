<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Pastikan hanya user yang sudah login yang bisa akses
        $this->middleware('auth');
        // Pastikan user sudah terverifikasi (kecuali admin)
        $this->middleware('verified.user');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Jika user adalah admin, redirect ke management user
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index');
        }

        // User biasa - hitung statistik surat
        $suratMasukCount = SuratMasuk::where('user_id', $user->id)->count();
        $suratKeluarCount = SuratKeluar::where('user_id', $user->id)->count();
        $arsipCount = $suratMasukCount + $suratKeluarCount;

        // Ambil 10 surat masuk dan keluar terbaru berdasarkan timestamp
        $suratMasukTerbaru = SuratMasuk::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        $suratKeluarTerbaru = SuratKeluar::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Gabungkan dan urutkan lagi berdasarkan waktu
        $arsipList = $suratMasukTerbaru
            ->concat($suratKeluarTerbaru)
            ->sortByDesc('created_at')
            ->take(10);

        return view('dashboard', compact(
            'suratMasukCount',
            'suratKeluarCount',
            'arsipCount',
            'arsipList'
        ));
    }
}
