<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
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

        $categories = Transaction::where('user_id', $user->id)
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->orderBy('total', 'desc')
            ->get();

        // Convert totals to percentages of overall category spending
        $totalSum = $categories->sum('total');
        $categories = $categories->map(function ($item) use ($totalSum) {
            $pct = $totalSum > 0 ? ($item->total / $totalSum) * 100 : 0;
            $item->percentage = round($pct, 2);
            return $item;
        });

        return view('reports.index', compact('monthlyData', 'categories'));
    }
}