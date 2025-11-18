@extends('layouts.user')

@section('title', 'Form Booking')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Form Pengajuan Sewa</h2>

    <div class="flex items-center mb-6 bg-blue-50 p-4 rounded-lg border border-blue-100">
        <div class="flex-1">
            <h3 class="font-bold text-lg text-blue-900">{{ $kos->name }}</h3>
            <p class="text-gray-600">{{ $kos->location }}</p>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Harga per bulan</p>
            <p class="font-bold text-blue-600 text-lg" id="pricePerMonth" data-price="{{ $kos->price }}">
                Rp {{ number_format($kos->price, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <form action="{{ route('booking.store', $kos->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Mulai Ngekos Tanggal Berapa?</label>
            <input type="date" name="start_date" class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Mau Sewa Berapa Bulan?</label>
            <select name="duration" id="duration" class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="1">1 Bulan</option>
                <option value="3">3 Bulan</option>
                <option value="6">6 Bulan</option>
                <option value="12">1 Tahun (12 Bulan)</option>
            </select>
        </div>

        <hr class="my-6">

        <div class="flex justify-between items-center mb-6">
            <span class="text-gray-600 font-bold text-lg">Total Pembayaran Pertama</span>
            <span class="text-3xl font-extrabold text-blue-700" id="totalPrice">
                Rp {{ number_format($kos->price, 0, ',', '.') }}
            </span>
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow transition">
            Ajukan Booking Sekarang 🏠
        </button>
    </form>
</div>

<script>
    const pricePerMonth = document.getElementById('pricePerMonth').getAttribute('data-price');
    const durationSelect = document.getElementById('duration');
    const totalPriceDisplay = document.getElementById('totalPrice');

    durationSelect.addEventListener('change', function() {
        const duration = this.value;
        const total = pricePerMonth * duration;

        // Format ke Rupiah
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);

        totalPriceDisplay.textContent = formatted;
    });
</script>
@endsection
