<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\BalanceHistory;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balances = Balance::with('user')->get();
        return view('balances.index', compact('balances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('balances.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'initial_balance' => 'required|numeric',
        ]);

        $existing = Balance::where('user_id', $validated['user_id'])->first();
        if ($existing) {
            $oldBalance = $existing->initial_balance;
            $existing->update(['initial_balance' => $validated['initial_balance'] + $oldBalance]);
            if ($validated['initial_balance'] != 0) {
                BalanceHistory::create([
                    'balance_id' => $existing->id,
                    'amount' => abs($validated['initial_balance']),
                    'type' => $validated['initial_balance'] > 0 ? 'credit' : 'debit',
                    'description' => 'Balance updated via create',
                ]);
            }
            return redirect()->route('balances.index')->with('success', 'Balance updated successfully!');
        }

        $balance = Balance::create($validated);

        // Catat history
        BalanceHistory::create([
            'balance_id' => $balance->id,
            'amount' => $balance->initial_balance,
            'type' => 'credit',
            'description' => 'Initial balance created',
        ]);

        return redirect()->route('balances.index')->with('success', 'Balance created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $balance = Balance::findOrFail($id);
        return view('balances.edit', compact('balance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $balance = Balance::findOrFail($id);
        $validated = $request->validate([
            'initial_balance' => 'required|numeric',
        ]);

        $oldBalance = $balance->initial_balance;
        $balance->update($validated);

        // Catat history perubahan
        $amountChange = $balance->initial_balance - $oldBalance;
        if ($amountChange != 0) {
            BalanceHistory::create([
                'balance_id' => $balance->id,
                'amount' => abs($amountChange),
                'type' => $amountChange > 0 ? 'credit' : 'debit',
                'description' => 'Balance updated',
            ]);
        }

        return redirect()->route('balances.index')->with('success', 'Balance updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $balance = Balance::findOrFail($id);
        // Hapus semua history terkait
        BalanceHistory::where('balance_id', $balance->id)->delete();
        $balance->delete();
        return redirect()->route('balances.index')->with('success', 'Balance dan history berhasil dihapus!');
    }
}
