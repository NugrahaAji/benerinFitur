<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller; 
use App\Models\User;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    /**
     * Tampilkan daftar user yang belum diverifikasi (Admin Only)
     */
    public function index()
    {
        $unverifiedUsers = User::where('is_verified', false)
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        $verifiedUsers = User::where('is_verified', true)
            ->where('role', '!=', 'admin')
            ->orderBy('verified_at', 'desc')
            ->get();

        return view('admin.users.verification', compact('unverifiedUsers', 'verifiedUsers'));
    }

    /**
     * Verifikasi user (Admin Only)
     */
    public function verify(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin tidak perlu diverifikasi.');
        }

        $user->update([
            'is_verified' => true,
            'verified_at' => now()
        ]);

        return redirect()->back()->with('success', "User {$user->name} berhasil diverifikasi.");
    }

    /**
     * Batalkan verifikasi user (Admin Only)
     */
    public function unverify(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Admin tidak bisa dibatalkan verifikasinya.');
        }

        $user->update([
            'is_verified' => false,
            'verified_at' => null
        ]);

        return redirect()->back()->with('success', "Verifikasi user {$user->name} berhasil dibatalkan.");
    }

    /**
     * Tampilkan halaman pending verification untuk user yang belum diverifikasi
     */
    public function pending()
    {
        return view('auth.verification-pending');
    }
}
