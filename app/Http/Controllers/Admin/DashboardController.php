<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    public function index()
    {
        // --- DATA KARTU (CARD) ---
        $totalKos = Kos::count();
        $kamarTerisi = Booking::where('status', 'active')->count();
        $pendapatan = Booking::whereIn('status', ['active', 'finished'])->sum('total_price');
        $totalPenyewa = User::where('role', 'user')->count();

        // --- DATA UNTUK GRAFIK PENDAPATAN (LINE CHART) ---
        // Mengambil total pendapatan per bulan di tahun ini
        $pendapatanBulanan = Booking::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total')
            )
            ->whereIn('status', ['active', 'finished'])
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        // Siapkan array kosong untuk 12 bulan (Jan-Des)
        $dataPendapatan = array_fill(1, 12, 0);

        // Gabungkan data database ke array bulanan
        foreach ($pendapatanBulanan as $bulan => $total) {
            $dataPendapatan[$bulan] = $total;
        }

        // values-nya untuk dikirim ke chart: [0, 500000, 0, 1200000, ...]
        $chartPendapatanValues = array_values($dataPendapatan);

        // Menghitung jumlah pesanan berdasarkan statusnya
        $statusPesanan = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // urutan label dan datanya
        $labelStatus = array_keys($statusPesanan);
        $dataStatus = array_values($statusPesanan);

        return view('admin.dashboard', compact(
            'totalKos', 'kamarTerisi', 'pendapatan', 'totalPenyewa',
            'chartPendapatanValues', 'labelStatus', 'dataStatus'
        ));
    }
}
