<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function pending()
    {
        $pendingUsers = User::where('role', 'user')
            ->where('is_verified', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.pending', compact('pendingUsers'));
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_verified) {
            return back()->with('info', 'User sudah terverifikasi.');
        }

        $user->update([
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'User berhasil diverifikasi.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_verified) {
            return back()->with('error', 'User sudah terverifikasi, tidak bisa ditolak.');
        }

        $user->delete();

        return back()->with('success', 'Pendaftaran user berhasil ditolak dan dihapus.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_verified' => !$user->is_verified,
        ]);

        $status = $user->is_verified ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil {$status}.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus user admin.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}

