<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Mengambil total user untuk statistik pertama
        $totalUsers = User::count();

        // 2. Mengambil 5 user terbaru untuk section 'Recent Members'
        $recentUsers = User::latest()->take(5)->get();

        // 3. Menghitung persentase pertumbuhan (Contoh statis, bisa dikembangkan dengan logic asli)
        $growth = 12;

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'totalUsers' => $totalUsers,
            'users' => $recentUsers, // Digunakan untuk list 'Recent Members'
            'growth' => $growth,
            'breadcrumbs' => [
                [
                    'title' => 'Dashboard',
                    'link' => route('dashboard')
                ]
            ]
        ]);
    }
}
