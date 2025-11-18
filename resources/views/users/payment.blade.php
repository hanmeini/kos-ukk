@extends('layouts.user')

@section('title', 'Pembayaran Sewa')

@section('content')
<div class="max-w-3xl mx-auto mt-10">

    <div class="bg-white p-8 rounded-t-xl shadow-md border-b-2 border-gray-100 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Selesaikan Pembayaran 💳</h1>
        <p class="text-gray-500 mt-2">Langkah terakhir sebelum kamar ini jadi milikmu!</p>
    </div>

    <div class="bg-white p-8 rounded-b-xl shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>
                <h3 class="font-bold text-gray-700 mb-4 uppercase text-sm tracking-wide">Rincian Pesanan</h3>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Nama Kos</p>
                        <p class="font-bold text-gray-800">{{ $booking->kos->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Durasi Sewa</p>
                        <p class="font-bold text-gray-800">{{ $booking->duration }} Bulan</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Mulai Tanggal</p>
                        <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                    </div>
                    <div class="border-t pt-3 mt-2">
                        <p class="text-xs text-gray-500">Total Tagihan</p>
                        <p class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-gray-700 mb-4 uppercase text-sm tracking-wide">Instruksi Transfer</h3>

                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6">
                    <p class="text-sm text-blue-800 mb-1">Silakan transfer ke Bank BCA:</p>
                    <p class="text-xl font-mono font-bold text-blue-900 select-all">123-456-7890</p>
                    <p class="text-sm text-blue-800 mt-1">a.n. Meiralia Kos Management</p>
                </div>

                <form action="{{ route('booking.pay', $booking->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti Transfer</label>
                        <input type="file" name="payment_proof" class="w-full px-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG. Pastikan tulisan terbaca jelas.</p>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition transform hover:-translate-y-1">
                        Kirim Bukti Pembayaran 🚀
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
