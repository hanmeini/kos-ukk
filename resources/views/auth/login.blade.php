<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - KosKita Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-screen bg-[#FDFBF7]"> <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-stone-900">
            <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
                 alt="Interior Rumah Mewah"
                 class="absolute inset-0 h-full w-full object-cover object-center opacity-90">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-stone-900/60 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-end p-16 w-full">
                <div class="w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mb-6 shadow-lg text-white text-2xl">
                    <i class="fas fa-quote-left"></i>
                </div>
                <h2 class="text-4xl font-bold text-white mb-4 leading-tight">
                    "Kenyamanan adalah prioritas utama kami."
                </h2>
                <p class="text-stone-300 text-lg max-w-md">
                    Bergabunglah dengan ribuan penyewa lainnya yang telah menemukan hunian impian dengan standar kualitas terbaik.
                </p>

                <div class="flex gap-2 mt-8">
                    <div class="w-8 h-1 bg-amber-500 rounded-full"></div>
                    <div class="w-2 h-1 bg-stone-600 rounded-full"></div>
                    <div class="w-2 h-1 bg-stone-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:px-20 xl:px-24 bg-[#FDFBF7]">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center justify-center lg:justify-start mb-6">
                        <div class="w-10 h-10 bg-stone-800 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-door-open text-amber-100"></i>
                        </div>
                        <span class="text-2xl font-bold text-stone-800">KosKita</span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-stone-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-stone-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-medium text-amber-600 hover:text-amber-500 transition">Daftar gratis di sini</a>
                    </p>
                </div>

                <div class="mt-10">
                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-stone-700">Alamat Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-stone-400 sm:text-sm"></i>
                                </div>
                                <input type="email" name="email" id="email" required class="block w-full pl-10 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="nama@email.com">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-stone-700">Kata Sandi</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-stone-400 sm:text-sm"></i>
                                </div>
                                <input type="password" name="password" id="password" required class="block w-full pl-10 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-stone-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-stone-600">Ingat saya</label>
                            </div>
                            <div class="text-sm">
                                <a href="#" class="font-medium text-amber-600 hover:text-amber-500">Lupa sandi?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-stone-800 hover:bg-stone-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-500 transition transform hover:-translate-y-0.5">
                                Masuk Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-stone-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-[#FDFBF7] text-stone-500">Atau kembali ke</span>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('home') }}" class="text-stone-600 font-medium hover:text-stone-800 hover:underline">Halaman Utama</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>
