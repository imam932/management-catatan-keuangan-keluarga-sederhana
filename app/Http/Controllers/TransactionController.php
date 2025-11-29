<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0'
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'category' => $request->category,
            'description' => $request->description,
            'amount' => $request->amount
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // authorization performed by middleware in constructor

        $request->validate([
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0'
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        // authorization performed by middleware in constructor
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}