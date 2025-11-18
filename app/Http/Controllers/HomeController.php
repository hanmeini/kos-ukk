<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kos; // Panggil model Kos

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data kos yang statusnya 'Tersedia', urutkan dari yang terbaru
        $koses = Kos::where('status', 'Tersedia')->latest()->get();

        return view('home', compact('koses'));
    }
    // ...
    public function show($id)
    {
        // Ambil data kos beserta fasilitasnya
        $kos = Kos::with('facilities')->findOrFail($id);

        return view('kos.show', compact('kos'));
    }

    public function search(Request $request)
    {
        $query = Kos::where('status', 'Tersedia');

        // Logika Pencarian (Search Bar)
        if ($request->has('keyword') && $request->keyword != null) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%")
                  ->orWhere('location', 'LIKE', "%$keyword%")
                  ->orWhere('description', 'LIKE', "%$keyword%");
            });
        }

        // Ambil data dengan Pagination (9 kos per halaman)
        $koses = $query->latest()->paginate(9);

        return view('kos.index', compact('koses'));
    }
}
