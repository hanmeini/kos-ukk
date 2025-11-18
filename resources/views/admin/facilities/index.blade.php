@extends('layouts.admin')

@section('title', 'Master Fasilitas')
@section('header', 'Kelola Fasilitas Kos')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="font-bold text-gray-700 mb-4">Daftar Fasilitas Tersedia</h3>

        <div class="flex flex-wrap gap-2">
            @foreach($facilities as $item)
                <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm flex items-center">
                    {{ $item->name }}

                    <form action="{{ route('facilities.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus fasilitas ini?');" class="ml-2">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold">&times;</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow h-fit">
        <h3 class="font-bold text-gray-700 mb-4">Tambah Baru</h3>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-2 text-sm">{{ session('success') }}</div>
        @endif

        <form action="{{ route('facilities.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2">Nama Fasilitas</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded focus:outline-none focus:border-blue-500" placeholder="Misal: Gym, Netflix, dll" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Simpan</button>
        </form>
    </div>

</div>
@endsection
