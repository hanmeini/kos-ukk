@extends('layouts.admin')

@section('title', 'Tambah Kos')
@section('header', 'Tambah Kamar Kos Baru')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">

        <form action="{{ route('admin.kos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Kos</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Contoh: Kos Melati Indah" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Harga per Bulan (Rp)</label>
                        <input type="number" name="price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Contoh: 1500000" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Lokasi</label>
                        <input type="text" name="location" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Foto Kos Utama</label>
                    <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none" required>
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-3">Fasilitas Tersedia</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($facilities as $facility)
                            <label class="inline-flex items-center bg-gray-50 p-3 rounded border hover:bg-blue-50 cursor-pointer transition">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}" class="form-checkbox h-5 w-5 text-blue-600 rounded">
                                <span class="ml-2 text-gray-700">{{ $facility->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('admin.kos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded font-bold hover:bg-gray-600 transition">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700 transition">Simpan Kos 🏠</button>
                </div>
            </div>
        </form>
    </div>
@endsection
