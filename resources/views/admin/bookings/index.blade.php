@extends('layouts.admin')

@section('title', 'Daftar Pesanan')
@section('header', 'Manajemen Pesanan Masuk')

@section('content')

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Penyewa</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kamar Kos</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal & Durasi</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 font-bold whitespace-no-wrap">{{ $booking->user->name }}</p>
                                <p class="text-gray-500 whitespace-no-wrap">{{ $booking->user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ $booking->kos->name }}</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</p>
                        <p class="text-gray-500 text-xs">{{ $booking->duration }} Bulan</p>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        @if($booking->payment_proof)
                            <a href="{{ asset('storage/'.$booking->payment_proof) }}" target="_blank" class="text-blue-500 text-xs underline">Lihat Bukti Bayar</a>
                        @endif
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        @php
                            $statusColor = match($booking->status) {
                                'pending' => 'bg-yellow-200 text-yellow-900',
                                'approved' => 'bg-blue-200 text-blue-900',
                                'paid' => 'bg-purple-200 text-purple-900', // Perlu Verifikasi
                                'active' => 'bg-green-200 text-green-900',
                                'rejected' => 'bg-red-200 text-red-900',
                                'finished' => 'bg-gray-200 text-gray-900',
                                default => 'bg-gray-200 text-gray-900'
                            };
                        @endphp
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $statusColor }} rounded-full">
                            <span class="relative">{{ ucfirst($booking->status) }}</span>
                        </span>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center gap-2">

                            @if($booking->status == 'pending')
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-xs" title="Setujui">
                                        <i class="fas fa-check"></i> Terima
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs" title="Tolak">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            @endif

                            @if($booking->status == 'paid')
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded text-xs font-bold">
                                        <i class="fas fa-check-double"></i> Verifikasi Lunas
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
