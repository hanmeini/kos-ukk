@extends('layouts.user')

@section('title', $kos->name)

@section('content')
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden my-8">
        <div class="md:flex">

            <div class="md:w-1/2">
                @if($kos->image)
                    <img class="h-96 w-full object-cover" src="{{ asset('storage/' . $kos->image) }}" alt="{{ $kos->name }}">
                @else
                    <img class="h-96 w-full object-cover" src="https://source.unsplash.com/600x800/?room,bedroom" alt="Placeholder">
                @endif
            </div>

            <div class="p-8 md:w-1/2 flex flex-col">
                <div class="uppercase tracking-wide text-sm text-blue-500 font-semibold">{{ $kos->location }}</div>
                <h1 class="block mt-1 text-3xl leading-tight font-bold text-black">{{ $kos->name }}</h1>

                <p class="mt-4 text-2xl text-gray-900 font-bold">
                    Rp {{ number_format($kos->price, 0, ',', '.') }}
                    <span class="text-base text-gray-500 font-normal">/ bulan</span>
                </p>

                <div class="mt-4">
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                        Status: {{ $kos->status }}
                    </span>
                </div>

                <hr class="my-6 border-gray-200">

                <h3 class="font-bold text-gray-700 mb-2">Deskripsi</h3>
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $kos->description }}
                </p>

                <h3 class="font-bold text-gray-700 mb-2">Fasilitas</h3>
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($kos->facilities as $facility)
                        <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-md text-sm border border-blue-100">
                            <i class="fas fa-check-circle mr-1"></i> {{ $facility->name }}
                        </span>
                    @endforeach
                </div>

                <div class="mt-auto">
                    @auth
                        @if(Auth::user()->role == 'user')
                            <a href="{{ route('booking.create', $kos->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg transition shadow-lg transform hover:-translate-y-1">
                                Ajukan Sewa Sekarang 🚀
                            </a>
                        @else
                            <button disabled class="block w-full bg-gray-400 text-white text-center font-bold py-3 px-4 rounded-lg cursor-not-allowed">
                                Admin tidak bisa menyewa
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-bold py-3 px-4 rounded-lg transition">
                            Login untuk Menyewa
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
