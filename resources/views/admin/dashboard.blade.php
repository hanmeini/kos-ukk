@extends('layouts.admin')

@section('title', 'Dashboard Utama')
@section('header', 'Ringkasan & Statistik')

@section('content')

    <!-- 1. KARTU RINGKASAN (Stats Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Card Total Kamar -->
        <div class="bg-white rounded-lg shadow p-5 border-b-4 border-blue-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Total Kamar</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $totalKos }}</h4>
                </div>
                <div class="bg-blue-100 p-3 rounded-full text-blue-600">
                    <i class="fas fa-bed fa-lg"></i>
                </div>
            </div>
        </div>

        <!-- Card Kamar Terisi -->
        <div class="bg-white rounded-lg shadow p-5 border-b-4 border-green-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Kamar Terisi</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $kamarTerisi }}</h4>
                </div>
                <div class="bg-green-100 p-3 rounded-full text-green-600">
                    <i class="fas fa-user-check fa-lg"></i>
                </div>
            </div>
        </div>

        <!-- Card Total Penyewa -->
        <div class="bg-white rounded-lg shadow p-5 border-b-4 border-yellow-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Total Penyewa</p>
                    <h4 class="text-2xl font-bold text-gray-800">{{ $totalPenyewa }}</h4>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                    <i class="fas fa-users fa-lg"></i>
                </div>
            </div>
        </div>

        <!-- Card Pendapatan -->
        <div class="bg-white rounded-lg shadow p-5 border-b-4 border-purple-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase">Pendapatan</p>
                    <h4 class="text-xl font-bold text-gray-800">Rp {{ number_format($pendapatan, 0, ',', '.') }}</h4>
                </div>
                <div class="bg-purple-100 p-3 rounded-full text-purple-600">
                    <i class="fas fa-wallet fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. AREA GRAFIK (Charts Area) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

        <!-- Grafik Pendapatan (Lebar: mengambil 2 kolom) -->
        <div class="bg-white p-6 rounded-lg shadow lg:col-span-2">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-chart-line mr-2 text-blue-500"></i> Grafik Pendapatan Tahun {{ date('Y') }}
            </h3>
            <div class="relative h-72 w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Grafik Status Pesanan (Lebar: 1 kolom) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-bold text-gray-700 mb-4 border-b pb-2">
                <i class="fas fa-chart-pie mr-2 text-pink-500"></i> Status Pesanan
            </h3>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- SCRIPT UNTUK CHART.JS -->
    <!-- Ambil library Chart.js dari CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- 1. KONFIGURASI CHART PENDAPATAN (BAR CHART) ---
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctxRevenue, {
            type: 'bar', // Bisa diganti 'line' kalau mau garis
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pendapatan (Rupiah)',
                    data: @json($chartPendapatanValues), // Data dari Controller
                    backgroundColor: 'rgba(59, 130, 246, 0.5)', // Warna Biru Transparan
                    borderColor: 'rgba(59, 130, 246, 1)', // Warna Biru Garis
                    borderWidth: 2,
                    borderRadius: 5,
                    tension: 0.4 // Kelengkungan garis (kalau type: line)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Format angka jadi Rupiah di sumbu Y
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // --- 2. KONFIGURASI CHART STATUS (DOUGHNUT CHART) ---
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($labelStatus), // ['pending', 'active', etc]
                datasets: [{
                    data: @json($dataStatus), // [5, 2, 1]
                    backgroundColor: [
                        '#FCD34D', // Kuning (Pending)
                        '#10B981', // Hijau (Active/Paid)
                        '#EF4444', // Merah (Rejected)
                        '#6B7280', // Abu (Finished)
                        '#3B82F6'  // Biru (Approved)
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

@endsection
