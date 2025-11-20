@extends('layouts.admin')

@section('title', 'Data Penyewa')
@section('header', 'Manajemen Penyewa')

@section('content')

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 shadow-sm">
            <div class="flex">
                <div class="py-1"><i class="fas fa-check-circle mr-2"></i></div>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">

        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Daftar Pengguna Terdaftar</h3>
                <p class="text-sm text-gray-500">Total Penyewa: {{ $users->count() }} Orang</p>
            </div>
            </div>

        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal tracking-wider">
                        <th class="py-4 px-6 text-left">Nama Penyewa</th>
                        <th class="py-4 px-6 text-left">Email / Kontak</th>
                        <th class="py-4 px-6 text-center">Bergabung</th>
                        <th class="py-4 px-6 text-center">Riwayat Booking</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-blue-50 transition duration-200">

                        <td class="py-4 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <img class="w-10 h-10 rounded-full border border-gray-200" src="https://ui-avatars.com/api/?name={{ $user->name }}&background=random" alt="Avatar">
                                </div>
                                <span class="font-bold text-gray-700 text-base">{{ $user->name }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 text-left">
                            <div class="flex items-center">
                                <i class="far fa-envelope mr-2 text-gray-400"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                        </td>

                        <td class="py-4 px-6 text-center">
                            <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-full text-xs">
                                {{ $user->created_at->format('d M Y') }}
                            </span>
                        </td>

                        <td class="py-4 px-6 text-center">
                            @if($user->bookings_count > 0)
                                <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-bold border border-blue-200">
                                    {{ $user->bookings_count }}x Sewa
                                </span>
                            @else
                                <span class="text-gray-400 italic text-xs">Belum pernah</span>
                            @endif
                        </td>

                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN: Menghapus user ini juga akan menghapus semua riwayat booking mereka. Yakin ingin melanjutkan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transform hover:scale-110 transition duration-200" title="Hapus User Permanen">
                                    <i class="fas fa-trash-alt text-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-users-slash text-4xl mb-3"></i>
                                <p>Belum ada penyewa yang mendaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
