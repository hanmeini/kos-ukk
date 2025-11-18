<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // 1. Tampilkan Form Booking
    public function create($id)
    {
        $kos = Kos::findOrFail($id);
        return view('users.booking.create', compact('kos'));
    }

    // 2. Simpan Booking
    public function store(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);

        $request->validate([
            'start_date' => 'required|date|after:today', // Harus tanggal besok dst
            'duration' => 'required|integer|min:1|max:12', // Min 1 bulan
        ]);

        // Hitung Total Harga otomatis
        $totalPrice = $kos->price * $request->duration;

        Booking::create([
            'user_id' => Auth::id(),
            'kos_id' => $kos->id,
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'total_price' => $totalPrice,
            'status' => 'pending', // Default status pending
        ]);

        // Redirect ke Dashboard User (Nanti kita buat)
        return redirect()->route('user.bookings.index')
            ->with('success', 'Permintaan sewa berhasil dikirim! Tunggu persetujuan pemilik kos ya. ⏳');
    }

    // 3. Tampilkan Halaman Pembayaran (Invoice)
    public function payment($id)
    {
        $booking = Booking::with('kos')->findOrFail($id);

        // Keamanan: Pastikan yang akses adalah pemilik booking itu sendiri
        if ($booking->user_id != Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        // Keamanan: Pastikan statusnya memang 'approved' (siap bayar)
        if ($booking->status != 'approved') {
            return redirect()->back()->with('error', 'Pesanan ini belum disetujui atau sudah dibayar.');
        }

        return view('users.payment', compact('booking'));
    }

    // 4. Proses Upload Bukti Bayar
    public function processPayment(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        // Validasi Gambar
        $request->validate([
            'payment_proof' => 'required|image|max:2048', // Maks 2MB
        ]);

        // Simpan Gambar Bukti
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');

            // Update Data Booking
            $booking->update([
                'payment_proof' => $path,
                'status' => 'paid' // Ubah status jadi 'Sudah Dibayar' (Menunggu Verifikasi)
            ]);
        }

        return redirect()->route('user.bookings.index')
                    ->with('success', 'Terima kasih! Bukti pembayaran sudah dikirim. Tunggu verifikasi admin ya. ⏳');
            }
}
