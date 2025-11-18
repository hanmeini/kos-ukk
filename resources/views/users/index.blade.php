@extends('layouts.user')

@section('title', 'Dashboard Saya')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="bg-white rounded-lg shadow-md p-6 mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-gray-600">Selamat datang di dashboard penyewa.</p>
        </div>
        <div class="hidden md:block">
            <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full font-bold text-sm">
                {{ $myBookings->count() }} Pesanan
            </span>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Riwayat & Status Sewa</h2>

    <div class="grid grid-cols-1 gap-6">
        @forelse($myBookings as $booking)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border border-gray-100">
                <div class="md:flex">
                    <div class="md:w-48 h-32 md:h-auto bg-gray-200">
                        @if($booking->kos->image)
                            <img src="{{ asset('storage/' . $booking->kos->image) }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://source.unsplash.com/200x200/?room" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <div class="p-6 flex-1 flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="mb-4 md:mb-0">
                            <h3 class="font-bold text-lg text-blue-900">{{ $booking->kos->name }}</h3>
                            <p class="text-sm text-gray-500 mb-1"><i class="fas fa-map-marker-alt"></i> {{ $booking->kos->location }}</p>
                            <p class="text-sm text-gray-600">
                                Durasi: <strong>{{ $booking->duration }} Bulan</strong>
                                <span class="mx-2 text-gray-300">|</span>
                                Mulai: {{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}
                            </p>
                        </div>

                        <div class="text-right w-full md:w-auto">
                            <div class="mb-2">
                                @if($booking->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-bold">Menunggu Konfirmasi</span>
                                @elseif($booking->status == 'approved')
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-bold">Siap Dibayar</span>
                                @elseif($booking->status == 'paid')
                                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-bold">Menunggu Verifikasi</span>
                                @elseif($booking->status == 'active')
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-bold">Aktif (Lunas)</span>
                                @elseif($booking->status == 'rejected')
                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold">Ditolak</span>
                                @endif
                            </div>
                            <p class="text-xl font-bold text-gray-800">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            @if($booking->status == 'approved')
                                <a href="{{ route('booking.payment', $booking->id) }}" class="inline-block mt-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition">
                                    Bayar Sekarang 💳
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <p class="text-gray-500 mb-4">Kamu belum pernah menyewa kos.</p>
                <a href="/" class="text-blue-600 font-bold hover:underline">Cari kos dulu yuk!</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
