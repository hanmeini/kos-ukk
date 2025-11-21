@extends('layouts.admin')

@section('title', 'Data Kos')
@section('header', 'Daftar Kamar Kos')

@section('content')

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-700">Tabel Data Kos</h3>
            <a href="{{ route('admin.kos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition">
                <i class="fas fa-plus"></i> Tambah Kos Baru
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">Nama Kos</th>
                        <th class="py-3 px-6">Lokasi</th>
                        <th class="py-3 px-6">Harga</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6">Foto</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($koses as $kos)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 font-medium">{{ $kos->name }}</td>
                        <td class="py-3 px-6">{{ $kos->location }}</td>
                        <td class="py-3 px-6">Rp {{ number_format($kos->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.kos.updateStatus', $kos->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status" onchange="this.form.submit()"
                                    class="text-xs font-bold rounded-full px-3 py-1 border-none focus:ring-2 cursor-pointer transition shadow-sm
                                    {{ $kos->status == 'Tersedia' ? 'bg-green-100 text-green-800 focus:ring-green-300' : '' }}
                                    {{ $kos->status == 'Penuh' ? 'bg-red-100 text-red-800 focus:ring-red-300' : '' }}
                                    {{ $kos->status == 'Tidak Tersedia' ? 'bg-stone-200 text-stone-600 focus:ring-stone-300' : '' }}
                                    ">

                                    <option value="Tersedia" {{ $kos->status == 'Tersedia' ? 'selected' : '' }}>
                                        ✅ Tersedia
                                    </option>
                                    <option value="Penuh" {{ $kos->status == 'Penuh' ? 'selected' : '' }}>
                                        ⛔ Penuh
                                    </option>
                                    <option value="Tidak Tersedia" {{ $kos->status == 'Tidak Tersedia' ? 'selected' : '' }}>
                                        🔧 Tidak Tersedia
                                    </option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3 px-6">
                            @if($kos->image)
                                <img src="{{ asset('storage/' . $kos->image) }}" class="w-16 h-16 object-cover rounded-lg shadow-sm" alt="Foto Kos">
                            @else
                                <span class="text-gray-400 italic">No Image</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">

                                <a href="{{ route('admin.kos.edit', $kos->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.kos.destroy', $kos->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kos ini? Data tidak bisa dikembalikan lho! 😢');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 bg-transparent border-none cursor-pointer" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-6 px-6 text-center text-gray-500">
                            Belum ada data kos. Yuk tambah dulu! 😊
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
