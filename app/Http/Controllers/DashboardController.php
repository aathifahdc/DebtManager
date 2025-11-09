<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = Auth::user();

        $totalDebts = $user->getTotalDebts();
        $totalCredits = $user->getTotalCredits();
        $totalDebtsPaid = $user->getTotalDebtsPaid();
        $totalCreditsReceived = $user->getTotalCreditsReceived();

        $recentDebts = $user->debts()->latest()->take(5)->get();
        $recentCredits = $user->credits()->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalDebts',
            'totalCredits',
            'totalDebtsPaid',
            'totalCreditsReceived',
            'recentDebts',
            'recentCredits'
        ));
    }
}
