<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $balance = Balance::where('user_id', $user->id)->first();
        if (!$balance) {
            $balance = Balance::create([
                'user_id' => $user->id,
                'initial_balance' => 0
            ]);
        }

        $todayExpenses = Transaction::where('user_id', $user->id)
            ->whereDate('date', today())
            ->sum('amount');

        $monthExpenses = Transaction::where('user_id', $user->id)
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');

        $monthlyData = Transaction::where('user_id', $user->id)
            ->select(
                DB::raw('YEAR(date) as year'),
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(amount) as total'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $endingBalance = $balance->initial_balance - $monthlyData->sum('total');

        return view('dashboard', compact(
            'balance',
            'todayExpenses',
            'monthExpenses',
            'endingBalance'
        ));
    }

    public function updateBalance(Request $request)
    {
        $request->validate([
            'initial_balance' => 'required|numeric|min:0'
        ]);

        $user = Auth::user();
        
        Balance::updateOrCreate(
            ['user_id' => $user->id],
            ['initial_balance' => $request->initial_balance]
        );

        return redirect()->route('dashboard')->with('success', 'Balance updated successfully!');
    }
}