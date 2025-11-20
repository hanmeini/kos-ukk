<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user biasa (bukan admin), hitung bookingnya
        $users = User::where('role', 'user')
                    ->withCount('bookings')
                    ->latest()
                    ->get();

        // Pastikan view mengarah ke 'admin.users.index'
        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data penyewa berhasil dihapus.');
    }
}
