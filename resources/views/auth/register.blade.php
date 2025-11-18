<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KosKita Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-screen bg-[#FDFBF7]">

    <div class="flex min-h-screen">

        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-stone-900">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80"
                 alt="Eksterior Modern"
                 class="absolute inset-0 h-full w-full object-cover object-center opacity-90">

            <div class="absolute inset-0 bg-gradient-to-t from-black via-stone-900/70 to-transparent"></div>

            <div class="relative z-10 flex flex-col justify-end p-16 w-full">
                <h2 class="text-4xl font-bold text-white mb-4">Mulai Hidup Baru Anda</h2>
                <p class="text-stone-300 text-lg max-w-lg mb-6">
                    Buat akun sekarang untuk mengakses ribuan listing kos eksklusif, atur jadwal survei, dan lakukan transaksi dengan aman.
                </p>

                <div class="flex gap-4 text-sm text-stone-400">
                    <div class="flex items-center"><i class="fas fa-check-circle text-amber-500 mr-2"></i> Transaksi Aman</div>
                    <div class="flex items-center"><i class="fas fa-check-circle text-amber-500 mr-2"></i> Terverifikasi</div>
                    <div class="flex items-center"><i class="fas fa-check-circle text-amber-500 mr-2"></i> Tanpa Biaya Admin</div>
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
                    <h2 class="text-3xl font-extrabold text-stone-900">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-stone-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-amber-600 hover:text-amber-500 transition">Masuk di sini</a>
                    </p>
                </div>

                <div class="mt-10">
                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-stone-700">Nama Lengkap</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="text" name="name" required class="block w-full px-4 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="Nama Anda">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700">Email</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="email" name="email" required class="block w-full px-4 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="email@contoh.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700">Kata Sandi</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="password" name="password" required class="block w-full px-4 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="Minimal 8 karakter">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-stone-700">Ulangi Kata Sandi</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="password" name="password_confirmation" required class="block w-full px-4 py-3 border-stone-300 rounded-lg bg-white focus:ring-amber-500 focus:border-amber-500 sm:text-sm shadow-sm" placeholder="Ketik ulang sandi">
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition transform hover:-translate-y-0.5">
                                Daftar Sekarang 🚀
                            </button>
                        </div>

                        <p class="text-xs text-center text-stone-500 mt-4">
                            Dengan mendaftar, Anda menyetujui <a href="#" class="underline hover:text-stone-800">Syarat & Ketentuan</a> kami.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
