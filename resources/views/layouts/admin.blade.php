<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Rental Kos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-gray-700 font-bold text-xl">
                🏢 Admin Kos
            </div>
            <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }} rounded-md transition">
                    <i class="fas fa-home w-6"></i> Dashboard
                </a>
                <a href="{{ route('facilities.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('facilities.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }} rounded-md transition">
                    <i class="fas fa-list-ul w-6"></i> Fasilitas
                </a>
                <a href="{{ route('admin.kos.index') }}" class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 rounded-md transition">
                    <i class="fas fa-bed w-6"></i> Data Kos
                </a>
                <a href="{{ route('admin.bookings.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }} rounded-md transition">
                    <i class="fas fa-file-invoice-dollar w-6"></i> Pesanan Masuk
                </a>
                <a href="{{ route('users.index') }}" class="flex items-center px-4 py-2 {{ request()->routeIs('users.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700' }} rounded-md transition">
                    <i class="fas fa-users-cog w-6"></i> Data Penyewa
                </a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center text-red-400 hover:text-red-200 transition">
                        <i class="fas fa-sign-out-alt w-6"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="flex justify-between items-center py-4 px-6 bg-white shadow border-b">
                <h2 class="text-2xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                <div class="flex items-center gap-3">
                    <span class="text-gray-600 hidden sm:block">Halo, {{ Auth::user()->name ?? 'Admin' }} 👋</span>
                    <img class="h-9 w-9 rounded-full object-cover border" src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'A' }}&background=random" alt="Avatar">
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>
