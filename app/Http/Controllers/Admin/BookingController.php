<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Daftar Semua Booking
    public function index()
    {
        $bookings = Booking::with(['user', 'kos'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // Update Status (Terima/Tolak/Verifikasi)
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'status' => 'required|in:approved,rejected,active,finished'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
