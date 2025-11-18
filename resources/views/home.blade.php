@extends('layouts.user')

@section('title', 'Hunian Nyaman & Elegan')

@section('content')

    <div class="relative h-[600px] flex items-center justify-center overflow-hidden">

        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                 alt="Rumah Elegan"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-stone-900/60"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <span class="block text-amber-400 font-bold tracking-widest uppercase text-sm mb-4 animate-fade-in-up">
                Selamat Datang di Rumah Kedua
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6 shadow-sm">
                Temukan Kenyamanan <br> <span class="text-amber-200">Tanpa Batas</span>
            </h1>
            <p class="text-lg md:text-xl text-stone-200 mb-10 font-light max-w-2xl mx-auto">
                Pilihan kamar kos eksklusif dengan suasana hangat, fasilitas lengkap, dan lingkungan yang tenang untuk istirahat berkualitas.
            </p>

        <form action="{{ route('kos.search') }}" method="GET" class="w-full max-w-xl mx-auto">
            <div class="bg-white/10 backdrop-blur-md p-2 rounded-full border border-white/20 flex shadow-2xl">
                <input type="text" name="keyword" class="grow bg-transparent border-none text-white placeholder-stone-300 px-6 py-3 focus:ring-0 focus:outline-none" placeholder="Cari lokasi impianmu...">
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-full font-bold transition transform hover:scale-105">
                    Cari
                </button>
            </div>
        </form>
        </div>
    </div>

    <div class="bg-stone-900 py-10 border-y border-stone-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-stone-700/50">
                <div>
                    <div class="text-3xl font-bold text-white mb-1">15k+</div>
                    <div class="text-sm text-amber-500 uppercase tracking-widest font-medium">Penyewa Aktif</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">800+</div>
                    <div class="text-sm text-amber-500 uppercase tracking-widest font-medium">Mitra Pemilik</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">50+</div>
                    <div class="text-sm text-amber-500 uppercase tracking-widest font-medium">Kota & Area</div>
                </div>
                <div>
                    <div class="text-3xl font-bold text-white mb-1">4.9</div>
                    <div class="text-sm text-amber-500 uppercase tracking-widest font-medium">Rating Rata-rata</div>
                </div>
            </div>
        </div>
    </div>



    <div class="py-20 bg-cream"> <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-stone-800">Layanan Prioritas</h2>
                <div class="w-20 h-1 bg-amber-600 mx-auto mt-4 rounded-full"></div>
                <p class="mt-4 text-stone-500">Kami mengutamakan kualitas hidup dan ketenangan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-amber-600">
                    <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mb-6 text-amber-700 text-2xl">
                        <i class="fas fa-couch"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Fully Furnished</h3>
                    <p class="text-stone-600 leading-relaxed text-sm">
                        Setiap kamar dilengkapi furnitur kayu berkualitas tinggi, kasur empuk, dan dekorasi estetis yang siap huni.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-amber-600">
                    <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mb-6 text-amber-700 text-2xl">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Housekeeping</h3>
                    <p class="text-stone-600 leading-relaxed text-sm">
                        Layanan pembersihan kamar rutin dan laundry profesional agar Anda bisa fokus pada aktivitas utama Anda.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-amber-600">
                    <div class="w-14 h-14 bg-amber-100 rounded-full flex items-center justify-center mb-6 text-amber-700 text-2xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-stone-800 mb-3">Keamanan 24/7</h3>
                    <p class="text-stone-600 leading-relaxed text-sm">
                        Sistem keamanan terpadu dengan CCTV dan akses kartu pintar untuk menjamin privasi dan ketenangan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-stone-800">Koleksi Terbaru</h2>
                <p class="text-stone-500 mt-2">Temukan ruang yang merefleksikan kepribadianmu.</p>
            </div>
            <a href="#" class="hidden md:inline-flex items-center text-amber-700 font-bold hover:text-amber-800 transition">
                Lihat Semua <i class="fas fa-long-arrow-alt-right ml-2"></i>
            </a>
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
                            <img src="https://source.unsplash.com/500x400/?interior,home&sig={{ $kos->id }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
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
                                <p class="text-amber-700 font-bold text-lg">Rp {{ number_format($kos->price, 0, ',', '.') }} <span class="text-xs text-stone-400 font-normal">/ bulan</span></p>
                            </div>
                            <a href="{{ route('kos.show', $kos->id) }}" class="bg-stone-800 hover:bg-stone-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition shadow-lg">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-20">
                    <div class="inline-block p-6 rounded-full bg-stone-100 mb-4 text-stone-400">
                        <i class="fas fa-home fa-3x"></i>
                    </div>
                    <h3 class="text-xl font-medium text-stone-800">Belum ada listing tersedia.</h3>
                    <p class="text-stone-500 mt-2">Silakan kembali lagi nanti.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="py-20 bg-stone-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-stone-800">Apa Kata Mereka?</h2>
                <p class="text-stone-500 mt-2">Cerita dari teman-teman yang sudah menemukan hunian barunya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-200 relative">
                    <i class="fas fa-quote-right text-4xl text-amber-100 absolute top-4 right-6"></i>
                    <p class="text-stone-600 italic mb-6 leading-relaxed">"Sumpah ngebantu banget! Biasanya cari kos harus muter-muter panas, sekarang tinggal klik, bayar, langsung check-in. Kamarnya sesuai ekspektasi."</p>
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <div class="ml-4">
                            <h4 class="text-stone-900 font-bold text-sm">Sarah Amalia</h4>
                            <p class="text-amber-600 text-xs">Mahasiswi UI</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-200 relative">
                    <i class="fas fa-quote-right text-4xl text-amber-100 absolute top-4 right-6"></i>
                    <p class="text-stone-600 italic mb-6 leading-relaxed">"Fitur filter fasilitasnya juara. Saya butuh kos yang ada parkir mobil dan AC, langsung nemu banyak pilihan dalam hitungan detik."</p>
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full object-cover" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <div class="ml-4">
                            <h4 class="text-stone-900 font-bold text-sm">Budi Santoso</h4>
                            <p class="text-amber-600 text-xs">Karyawan Swasta</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-200 relative">
                    <i class="fas fa-quote-right text-4xl text-amber-100 absolute top-4 right-6"></i>
                    <p class="text-stone-600 italic mb-6 leading-relaxed">"Proses bookingnya aman, uang langsung masuk ke sistem jadi gak takut ditipu pemilik kos nakal. Adminnya juga fast response."</p>
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full object-cover" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        <div class="ml-4">
                            <h4 class="text-stone-900 font-bold text-sm">Jessica Tan</h4>
                            <p class="text-amber-600 text-xs">Freelancer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="bg-stone-800 py-20 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Masih Bingung Cari Pilihan?</h2>
            <p class="text-stone-300 text-lg mb-10 max-w-2xl mx-auto font-light">
                Jangan ragu untuk berkonsultasi dengan tim kami. Kami siap membantu mencarikan kamar yang paling pas dengan budget dan kebutuhanmu.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281234567890" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-2">
                    <i class="fab fa-whatsapp text-xl"></i> Chat WhatsApp Admin
                </a>
                <a href="{{ route('kos.search') }}" class="bg-transparent border border-stone-500 text-stone-300 hover:text-white hover:border-white font-bold py-3 px-8 rounded-full transition">
                    Lihat Semua Kamar
                </a>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-stone-800">Pertanyaan Umum</h2>
            </div>

            <div class="space-y-4">
                <div x-data="{ open: false }" class="border border-stone-200 rounded-lg">
                    <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                        <span class="text-stone-700 font-medium">Bagaimana cara melakukan pembayaran?</span>
                        <i :class="open ? 'fa-minus' : 'fa-plus'" class="fas text-stone-400 text-sm"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-4 text-stone-500 text-sm leading-relaxed border-t border-stone-100 bg-stone-50" x-cloak>
                        Kami menerima pembayaran melalui Transfer Bank (BCA, Mandiri, BNI, BRI) dan E-Wallet. Setelah transfer, silakan upload bukti pembayaran di dashboard Anda.
                    </div>
                </div>

                <div x-data="{ open: false }" class="border border-stone-200 rounded-lg">
                    <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                        <span class="text-stone-700 font-medium">Apakah biaya sewa sudah termasuk listrik?</span>
                        <i :class="open ? 'fa-minus' : 'fa-plus'" class="fas text-stone-400 text-sm"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-4 text-stone-500 text-sm leading-relaxed border-t border-stone-100 bg-stone-50" x-cloak>
                        Tergantung masing-masing kos. Cek detail fasilitas di halaman deskripsi kos. Biasanya jika ada keterangan "Termasuk Listrik", maka Anda tidak perlu bayar lagi.
                    </div>
                </div>

                <div x-data="{ open: false }" class="border border-stone-200 rounded-lg">
                    <button @click="open = !open" class="flex justify-between items-center w-full px-6 py-4 text-left focus:outline-none">
                        <span class="text-stone-700 font-medium">Bisakah saya membatalkan pesanan?</span>
                        <i :class="open ? 'fa-minus' : 'fa-plus'" class="fas text-stone-400 text-sm"></i>
                    </button>
                    <div x-show="open" class="px-6 pb-4 text-stone-500 text-sm leading-relaxed border-t border-stone-100 bg-stone-50" x-cloak>
                        Pembatalan bisa dilakukan sebelum pembayaran dikonfirmasi oleh Admin. Jika sudah lunas, pengembalian dana mengikuti kebijakan masing-masing pemilik kos.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
