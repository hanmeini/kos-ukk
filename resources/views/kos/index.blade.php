@extends('layouts.user')

@section('title', 'Cari Kos')

@section('content')

    <div class="bg-stone-800 py-12 border-b-4 border-amber-600">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl font-bold text-white mb-2">Temukan Hunian Impianmu</h1>
            <p class="text-stone-400 mb-8">Cari berdasarkan nama kos, lokasi, atau fasilitas.</p>

            <form action="{{ route('kos.search') }}" method="GET" class="max-w-2xl mx-auto">
                <div class="flex shadow-lg rounded-full overflow-hidden p-1 bg-white/10 backdrop-blur-sm border border-white/20">
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        class="grow px-6 py-3 bg-transparent text-white placeholder-stone-300 focus:outline-none border-none"
                        placeholder="Ketik lokasi (misal: Jakarta Selatan)...">
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-bold transition">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="mb-6">
            @if(request('keyword'))
                <p class="text-stone-600">Menampilkan hasil untuk: <span class="font-bold text-stone-900">"{{ request('keyword') }}"</span></p>
            @else
                <p class="text-stone-600">Menampilkan semua kos tersedia</p>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($koses as $kos)
                <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition duration-500 border border-stone-100 flex flex-col h-full">
                    <div class="relative h-64 overflow-hidden">
                        <div class="absolute top-4 right-4 z-10 bg-stone-900/80 backdrop-blur-sm text-amber-400 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-amber-500/30">
                            {{ $kos->status }}
                        </div>
                        @if($kos->image)
                            <img src="{{ asset('storage/' . $kos->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        @else
                            <img src="https://source.unsplash.com/500x400/?interior,room&sig={{ $kos->id }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        @endif
                        <div class="absolute inset-x-0 bottom-0 h-24 bg-linear-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white font-medium flex items-center">
                            <i class="fas fa-map-marker-alt text-amber-400 mr-2"></i> {{ $kos->location }}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col grow">
                        <h3 class="text-xl font-bold text-stone-800 mb-2 group-hover:text-amber-700 transition">{{ $kos->name }}</h3>
                        <p class="text-stone-500 text-sm mb-4 line-clamp-2 grow font-light">
                            {{ $kos->description }}
                        </p>
                        <div class="border-t border-stone-100 pt-4 flex justify-between items-center mt-auto">
                            <div>
                                <p class="text-xs text-stone-400 uppercase tracking-wide">Harga Sewa</p>
                                <p class="text-amber-700 font-bold text-lg">Rp {{ number_format($kos->price, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('kos.show', $kos->id) }}" class="bg-stone-800 hover:bg-stone-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition shadow-lg">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20 bg-white rounded-xl border border-dashed border-stone-300">
                    <div class="inline-block p-4 rounded-full bg-stone-100 mb-4 text-stone-400">
                        <i class="fas fa-search fa-3x"></i>
                    </div>
                    <h3 class="text-xl font-medium text-stone-800">Tidak ditemukan.</h3>
                    <p class="text-stone-500 mt-2">Coba kata kunci lain atau cek kembali nanti.</p>
                    <a href="{{ route('kos.search') }}" class="inline-block mt-4 text-amber-700 font-bold hover:underline">Lihat Semua Kos</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $koses->withQueryString()->links() }}
        </div>
    </div>

@endsection
