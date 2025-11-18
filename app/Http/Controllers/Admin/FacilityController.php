<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    // Tampilkan daftar fasilitas
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.facilities.index', compact('facilities'));
    }

    // Simpan fasilitas baru
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50']);
        Facility::create($request->all());
        return back()->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    // Hapus fasilitas
    public function destroy($id)
    {
        Facility::destroy($id);
        return back()->with('success', 'Fasilitas dihapus!');
    }
}
