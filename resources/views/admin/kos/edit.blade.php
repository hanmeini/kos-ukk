@extends('layouts.admin')

@section('title', 'Edit Kos')
@section('header', 'Edit Data Kos')

@section('content')
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">

        <form action="{{ route('admin.kos.update', $kos->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Kos</label>
                    <input type="text" name="name" value="{{ old('name', $kos->name) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Harga per Bulan (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $kos->price) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Lokasi</label>
                        <input type="text" name="location" value="{{ old('location', $kos->location) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Foto Kos</label>

                    @if($kos->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $kos->image) }}" class="w-32 h-32 object-cover rounded border">
                            <p class="text-xs text-gray-500">Gambar saat ini</p>
                        </div>
                    @endif

                    <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg bg-gray-50 focus:outline-none">
                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-3">Fasilitas Tersedia</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($facilities as $facility)
                            <label class="inline-flex items-center bg-gray-50 p-3 rounded border hover:bg-blue-50 cursor-pointer transition">
                                <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                    class="form-checkbox h-5 w-5 text-blue-600 rounded"
                                    {{ $kos->facilities->contains($facility->id) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700">{{ $facility->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>{{ old('description', $kos->description) }}</textarea>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('admin.kos.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded font-bold hover:bg-gray-600 transition">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700 transition">Update Kos 💾</button>
                </div>
            </div>
        </form>
    </div>
@endsection
