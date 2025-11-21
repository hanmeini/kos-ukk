<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos;
use App\Models\Facility; // Pastikan Model Facility di-import

class HomeController extends Controller
{
    /**
     * Halaman Utama (Landing Page)
     */
    public function index()
    {
        // Ambil 6 kos terbaru yang statusnya 'Tersedia' untuk ditampilkan di Home
        $koses = Kos::where('status', 'Tersedia')->latest()->take(6)->get();

        return view('home', compact('koses'));
    }

    /**
     * Halaman Detail Kos
     */
    public function show($id)
    {
        // Ambil data kos beserta fasilitasnya
        $kos = Kos::with('facilities')->findOrFail($id);

        return view('kos.show', compact('kos'));
    }

    /**
     * Halaman Pencarian & Filter (Katalog)
     */
    public function search(Request $request)
    {
        // 1. Mulai Query Dasar (Hanya ambil yang statusnya Tersedia)
        $query = Kos::where('status', 'Tersedia');

        // 2. Filter Keyword (Nama, Lokasi, atau Deskripsi)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('location', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // 3. Filter Harga Minimum
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // 4. Filter Harga Maksimum
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 5. Filter Fasilitas (Relasi Many-to-Many)
        // Jika user mencentang fasilitas, kita cari kos yang MEMILIKI fasilitas tersebut
        if ($request->has('facilities') && is_array($request->facilities)) {
            foreach ($request->facilities as $facility_id) {
                // Gunakan whereHas untuk mengecek relasi
                $query->whereHas('facilities', function($q) use ($facility_id) {
                    $q->where('facilities.id', $facility_id);
                });
            }
        }

        // 6. Eksekusi Query dengan Pagination (9 item per halaman)
        // with('facilities') ditambahkan agar query lebih efisien (Eager Loading)
        $koses = $query->with('facilities')->latest()->paginate(9);

        // 7. Ambil Data Fasilitas untuk Sidebar
        // Ini agar checkbox di sidebar muncul sesuai database
        $facilities = Facility::all();

        // 8. Kirim ke View
        return view('kos.index', compact('koses', 'facilities'));
    }
}
