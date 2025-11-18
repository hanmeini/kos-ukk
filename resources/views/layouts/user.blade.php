<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KosKita') - Hunian Elegan</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .bg-cream { background-color: #FDFBF7; }
    </style>
</head>
<body class="bg-cream font-sans text-stone-800 flex flex-col min-h-screen">

    <nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }" class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">

                <div class="flex">
                    <div class="shrink-0 flex items-center cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                        <div class="w-10 h-10 bg-stone-800 rounded-lg flex items-center justify-center mr-2 shadow-md">
                            <i class="fas fa-door-open text-amber-100 text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-stone-800 tracking-tight leading-none">KosKita</h1>
                            <span class="text-xs text-amber-700 font-semibold tracking-widest uppercase">Premium Living</span>
                        </div>
                    </div>

                    <div class="hidden md:ml-12 md:flex md:space-x-8 items-center">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-amber-700 border-b-2 border-amber-600' : 'text-stone-500 hover:text-amber-700 hover:border-stone-300' }} inline-flex items-center px-1 pt-1 text-sm font-bold transition h-full border-b-2 border-transparent">
                            Beranda
                        </a>
                        <a href="{{ route('kos.search') }}" class="{{ request()->routeIs('kos.search') ? 'text-amber-800 border-b-2 border-amber-700' : 'text-stone-500 hover:text-amber-800' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition h-full">
                            Cari Kos
                        </a>

                        <a href="{{ route('home') }}" class="text-stone-500 hover:text-amber-800 inline-flex items-center px-1 pt-1 text-sm font-medium transition h-full">
                            Layanan
                        </a>
                    </div>
                </div>

                <div class="hidden md:ml-6 md:flex md:items-center space-x-4">
                    @auth
                        <div class="relative ml-3">
                            <button @click="userDropdownOpen = !userDropdownOpen" @click.away="userDropdownOpen = false" class="flex items-center gap-2 focus:outline-none hover:bg-stone-50 p-2 rounded-full transition">
                                <span class="text-stone-700 font-bold text-sm text-right leading-tight">
                                    Halo,<br>{{ Auth::user()->name }}
                                </span>
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-amber-200" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=78350F&color=FFF" alt="">
                            </button>

                            <div x-show="userDropdownOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-56 rounded-xl shadow-2xl py-2 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" x-cloak>

                                <div class="px-4 py-2 border-b border-stone-100 mb-1">
                                    <p class="text-xs text-stone-400 uppercase">Akun</p>
                                    <p class="text-sm font-bold text-stone-800 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                @if(Auth::user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700"><i class="fas fa-tachometer-alt w-5"></i> Dashboard Admin</a>
                                @else
                                    <a href="{{ route('user.bookings.index') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700"><i class="fas fa-home w-5"></i> Kos Saya</a>
                                @endif

                                <form action="{{ route('logout') }}" method="POST" class="mt-1 border-t border-stone-100">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt w-5"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-stone-600 hover:text-amber-800 font-bold px-4 py-2 text-sm transition">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-stone-800 hover:bg-stone-700 text-amber-50 px-6 py-2.5 rounded-full text-sm font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>

                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-stone-600 hover:bg-stone-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500">
                        <span class="sr-only">Open main menu</span>
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-white border-t border-stone-200 absolute w-full shadow-xl" x-cloak>

            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-amber-50 border-amber-600 text-amber-900' : 'border-transparent text-stone-600 hover:bg-stone-50 hover:border-stone-300' }} border-l-4 block pl-3 pr-4 py-3 text-base font-medium rounded-r-md">
                    Beranda
                </a>

                <a href="{{ route('kos.search') }}" class="{{ request()->routeIs('kos.search') ? 'bg-amber-50 border-amber-600 text-amber-900' : 'border-transparent text-stone-600 hover:bg-stone-50 hover:border-stone-300' }} border-l-4 block pl-3 pr-4 py-3 text-base font-medium rounded-r-md">
                    Cari Kos
                </a>

                <a href="{{ route('home') }}" class="border-l-4 border-transparent text-stone-600 hover:bg-stone-50 hover:border-stone-300 hover:text-stone-800 block pl-3 pr-4 py-3 text-base font-medium rounded-r-md">
                    Layanan Kami
                </a>
            </div>

            <div class="pt-4 pb-6 border-t border-stone-200 bg-stone-50">
                @auth
                    <div class="flex items-center px-5 mb-4">
                        <div class="shrink-0">
                            <img class="h-10 w-10 rounded-full border-2 border-white shadow-sm" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=78350F&color=FFF" alt="">
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-bold text-stone-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-stone-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="space-y-1 px-2">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-stone-600 hover:text-stone-800 hover:bg-white shadow-sm">Dashboard Admin</a>
                        @else
                            <a href="{{ route('user.bookings.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-stone-600 hover:text-stone-800 hover:bg-white shadow-sm">Dashboard Saya</a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:bg-red-50 hover:text-red-800">
                                Keluar
                            </button>
                        </form>
                    </div>
                @else
                    <div class="px-5 space-y-3">
                        <a href="{{ route('login') }}" class="block w-full text-center px-4 py-3 border border-stone-300 rounded-lg shadow-sm text-base font-bold text-stone-700 bg-white hover:bg-stone-50">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="block w-full text-center px-4 py-3 border border-transparent rounded-lg shadow-md text-base font-bold text-white bg-stone-800 hover:bg-stone-700">
                            Daftar Akun
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="grow">
        @yield('content')
    </main>

    <footer class="bg-stone-900 text-stone-300 py-12 border-t-4 border-amber-700">
        <div class="max-w-7xl mx-auto px-4 text-center md:text-left">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white text-lg font-bold mb-4 flex items-center justify-center md:justify-start">
                        <i class="fas fa-door-open mr-2 text-amber-500"></i> KosKita
                    </h3>
                    <p class="text-sm leading-relaxed text-stone-400">Menyediakan hunian kos eksklusif dengan kenyamanan seperti di rumah sendiri. Aman, bersih, dan terjangkau.</p>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-amber-500 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Karir</a></li>
                        <li><a href="#" class="hover:text-amber-500 transition">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Hubungi Kami</h3>
                    <p class="text-sm text-stone-400"><i class="fas fa-envelope mr-2 text-amber-600"></i> hello@koskita.com</p>
                    <p class="text-sm text-stone-400 mt-2"><i class="fab fa-whatsapp mr-2 text-green-500"></i> +62 812 3456 7890</p>
                </div>
            </div>
            <div class="border-t border-stone-800 mt-8 pt-8 text-center text-xs text-stone-500">
                &copy; {{ date('Y') }} KosKita. Premium Living Experience.
            </div>
        </div>
    </footer>

</body>
</html>
