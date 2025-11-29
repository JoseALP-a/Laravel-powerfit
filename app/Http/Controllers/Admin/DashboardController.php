<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Models\Rutina;
use App\Models\Ejercicio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas principales
        $totalUsuarios = User::count();
        $totalAdmins = Admin::count();
        $totalRutinas = Rutina::count();
        $totalEjercicios = Ejercicio::count();

        // Gráfica: nuevos usuarios por mes (últimos 6 meses)
        $months = collect(range(0, 5))
            ->map(function ($i) {
                return Carbon::now()->subMonths($i)->format('Y-m');
            })
            ->reverse()
            ->values();

        $usersPerMonth = $months->map(function ($month) {
            [$year, $m] = explode('-', $month);
            return User::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->count();
        });

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalAdmins',
            'totalRutinas',
            'totalEjercicios',
            'months',
            'usersPerMonth'
        ));
    }
}
