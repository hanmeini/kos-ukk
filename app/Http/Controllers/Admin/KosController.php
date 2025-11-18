<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KosController extends Controller
{
    public function index()
    {
        $koses = Kos::latest()->get();
        return view('admin.kos.index', compact('koses'));
    }

    public function create()
    {
        // Ambil semua fasilitas buat ditampilkan di checkbox
        $facilities = Facility::all();
        return view('admin.kos.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'facilities' => 'array'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('kos-images', 'public');
        }

        $kos = Kos::create([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
            'status' => 'Tersedia',
            'image' => $imagePath
        ]);

        if ($request->has('facilities')) {
            $kos->facilities()->attach($request->facilities);
        }

        return redirect()->route('admin.kos.index')->with('success', 'Kos berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kos = Kos::findOrFail($id);
        $facilities = Facility::all();

        return view('admin.kos.edit', compact('kos', 'facilities'));
    }

    // 5. Proses Update Data
    public function update(Request $request, $id)
    {
        $kos = Kos::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'description' => 'required',
            'image' => 'nullable|image|max:2048', // Nullable: gak wajib ganti foto
            'facilities' => 'array'
        ]);

        // Cek apakah user upload gambar baru?
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($kos->image) {
                Storage::disk('public')->delete($kos->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('kos-images', 'public');
            $kos->image = $imagePath; // Update path di object kos
        }

        // Update data teks
        $kos->update([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'description' => $request->description,
            // 'image' sudah dihandle di atas
        ]);

        // Sinkronisasi Fasilitas (Hapus yang lama, masukkan yang baru)
        if ($request->has('facilities')) {
            $kos->facilities()->sync($request->facilities);
        } else {
            $kos->facilities()->detach(); // Kalau uncheck semua, hapus relasi
        }

        return redirect()->route('admin.kos.index')->with('success', 'Data kos berhasil diperbarui! ✨');
    }

    // 6. Hapus Kos
    public function destroy($id)
    {
        $kos = Kos::findOrFail($id);

        // Hapus file gambar dari penyimpanan
        if ($kos->image) {
            Storage::disk('public')->delete($kos->image);
        }

        // Hapus data dari database
        $kos->delete();

        return redirect()->route('admin.kos.index')->with('success', 'Kos berhasil dihapus selamanya 🗑️');
    }
}
