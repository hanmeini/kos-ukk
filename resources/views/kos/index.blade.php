@extends('layouts.user')

@section('title', 'Cari Kos')

@section('content')

    <div class="min-h-screen bg-white pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 text-center lg:text-left">
                <h1 class="text-3xl font-serif font-bold text-stone-800">Katalog Hunian</h1>
                <p class="text-stone-500 text-sm mt-1">Temukan kos yang paling pas dengan kebutuhanmu.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <div class="lg:col-span-1" x-data="{ showFilter: false }">

                    <button @click="showFilter = !showFilter"
                        class="lg:hidden w-full bg-white border border-stone-200 p-4 rounded-xl flex justify-between items-center shadow-sm mb-4 transition hover:bg-stone-50">
                        <span class="font-bold text-stone-800 flex items-center gap-2">
                            <i class="fas fa-filter text-amber-600"></i> Filter Pencarian
                        </span>
                        <i class="fas fa-chevron-down text-stone-400 transition-transform duration-300"
                           :class="showFilter ? 'rotate-180' : ''"></i>
                    </button>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 lg:sticky lg:top-24"
                         :class="showFilter ? 'block' : 'hidden lg:block'">

                        <form action="{{ route('kos.search') }}" method="GET">

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-stone-500 uppercase tracking-wide mb-2">Kata Kunci</label>
                                <input type="text" name="keyword" value="{{ request('keyword') }}"
                                    class="w-full px-4 py-2 border border-stone-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400 text-sm bg-stone-50"
                                    placeholder="Lokasi / nama...">
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-stone-500 uppercase tracking-wide mb-2">Harga (Rp)</label>
                                <div class="space-y-2">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}"
                                        class="w-full px-3 py-2 border border-stone-200 rounded-lg text-sm bg-stone-50 focus:ring-1 focus:ring-amber-400 outline-none" placeholder="Min">
                                    <input type="number" name="max_price" value="{{ request('max_price') }}"
                                        class="w-full px-3 py-2 border border-stone-200 rounded-lg text-sm bg-stone-50 focus:ring-1 focus:ring-amber-400 outline-none" placeholder="Max">
                                </div>
                            </div>

                            <div class="mb-8">
                                <label class="block text-xs font-bold text-stone-500 uppercase tracking-wide mb-3">Fasilitas</label>
                                <div class="space-y-2 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                    @if(isset($facilities) && $facilities->count() > 0)
                                        @foreach($facilities as $facility)
                                            <label class="flex items-center gap-3 cursor-pointer group p-1 hover:bg-stone-50 rounded transition">
                                                <div class="relative flex items-center">
                                                    <input type="checkbox" name="facilities[]" value="{{ $facility->id }}"
                                                        class="peer h-4 w-4 cursor-pointer appearance-none rounded border border-stone-300 checked:border-amber-500 checked:bg-amber-500 transition-all"
                                                        {{ in_array($facility->id, request('facilities', [])) ? 'checked' : '' }}>
                                                    <i class="fas fa-check absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100 text-[10px]"></i>
                                                </div>
                                                <span class="text-sm text-stone-600 group-hover:text-amber-700 transition select-none">{{ $facility->name }}</span>
                                            </label>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-stone-400 italic">Belum ada data fasilitas.</p>
                                    @endif
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-stone-800 hover:bg-stone-900 text-white font-bold py-3 rounded-xl transition shadow-lg text-sm">
                                Terapkan Filter
                            </button>

                            @if(request()->hasAny(['keyword', 'min_price', 'max_price', 'facilities']))
                                <a href="{{ route('kos.search') }}" class="block text-center mt-4 text-xs text-stone-500 hover:text-red-500 transition font-medium">
                                    <i class="fas fa-redo-alt mr-1"></i> Reset Filter
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-3">

                    <div class="flex justify-between items-center mb-6 px-1">
                        <p class="text-stone-600 text-sm">
                            Ditemukan <span class="font-bold text-stone-900">{{ $koses->total() }}</span> properti
                            @if(request('keyword')) untuk "<span class="font-bold">{{ request('keyword') }}</span>" @endif
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($koses as $kos)
                            <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-stone-100 flex flex-col h-full">

                                <div class="relative h-60 overflow-hidden">
                                    <div class="absolute top-3 left-3 z-10">
                                        <span class="bg-white/95 backdrop-blur px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider text-stone-800 shadow-sm border border-stone-200">
                                            {{ $kos->status }}
                                        </span>
                                    </div>

                                    <a href="{{ route('kos.show', $kos->id) }}">
                                        @if($kos->image)
                                            <img src="{{ asset('storage/' . $kos->image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out" alt="{{ $kos->name }}">
                                        @else
                                            <img src="https://source.unsplash.com/600x800/?interior,home&sig={{ $kos->id }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out" alt="Placeholder">
                                        @endif

                                        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>

                                        <div class="absolute bottom-3 left-3 text-white font-medium flex items-center text-sm shadow-sm">
                                            <i class="fas fa-map-marker-alt text-amber-400 mr-2"></i> {{ Str::limit($kos->location, 30) }}
                                        </div>
                                    </a>
                                </div>

                                <div class="p-5 flex flex-col grow">
                                    <h3 class="font-serif text-lg font-bold text-stone-800 mb-2 leading-snug group-hover:text-amber-700 transition">
                                        <a href="{{ route('kos.show', $kos->id) }}">{{ $kos->name }}</a>
                                    </h3>

                                    <p class="text-stone-500 text-sm mb-4 line-clamp-2 font-light leading-relaxed flex-grow">
                                        {{ $kos->description }}
                                    </p>

                                    <div class="border-t border-stone-100 mt-auto pt-4 flex items-center justify-between">
                                        <div>
                                            <p class="text-[10px] text-stone-400 uppercase tracking-wide mb-0.5">Harga Sewa</p>
                                            <p class="text-stone-900 font-bold text-lg">
                                                Rp {{ number_format($kos->price, 0, ',', '.') }}
                                                <span class="text-xs text-stone-400 font-normal">/bln</span>
                                            </p>
                                        </div>
                                        <a href="{{ route('kos.show', $kos->id) }}" class="bg-stone-100 hover:bg-amber-600 hover:text-white text-stone-600 w-9 h-9 rounded-full flex items-center justify-center transition shadow-sm transform group-hover:rotate-[-45deg] duration-300">
                                            <i class="fas fa-arrow-right text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center py-16 text-center bg-white rounded-2xl border border-dashed border-stone-200">
                                <div class="w-16 h-16 bg-stone-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fas fa-search text-stone-300 text-2xl"></i>
                                </div>
                                <h3 class="font-serif text-xl text-stone-800 mb-1">Tidak ada hasil</h3>
                                <p class="text-stone-500 text-sm max-w-xs mx-auto mb-6">
                                    Tidak ada kos yang cocok dengan kombinasi filter ini.
                                </p>
                                <a href="{{ route('kos.search') }}" class="text-sm font-bold text-amber-600 hover:underline">
                                    Hapus semua filter
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-12">
                        {{ $koses->withQueryString()->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
