<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data booking milik user yang sedang login saja
        $myBookings = Booking::with('kos')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('users.index', compact('myBookings'));
    }
}
