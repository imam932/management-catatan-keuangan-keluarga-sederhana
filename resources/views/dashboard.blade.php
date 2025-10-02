<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Finance Tracker - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-dark text-white vh-100">
                <div class="p-3">
                    <h4 class="text-center mb-4">Family Finance</h4>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('transactions.index') }}" class="nav-link text-white">Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link text-white">Reports</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="p-4">
                    <h2 class="mb-4">Dashboard</h2>
                    
                    @if($balance->initial_balance == 0)
                    <div class="alert alert-warning">
                        <h5>Welcome! Set your initial balance to get started.</h5>
                        <form method="POST" action="{{ route('balance.update') }}" class="row g-3">
                            @csrf
                            <div class="col-auto">
                                <input type="number" step="0.01" name="initial_balance" class="form-control" placeholder="Initial Balance" required>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Set Balance</button>
                            </div>
                        </form>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Initial Balance</h6>
                                    <h3 class="card-text">${{ number_format($balance->initial_balance, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Today's Expenses</h6>
                                    <h3 class="card-text">${{ number_format($todayExpenses, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <h6 class="card-title">This Month's Expenses</h6>
                                    <h3 class="card-text">${{ number_format($monthExpenses, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Ending Balance</h6>
                                    <h3 class="card-text">${{ number_format($endingBalance, 2) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Recent Transactions</h4>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add Expense</a>
                        </div>
                        
                        @php
                            $recentTransactions = \App\Models\Transaction::where('user_id', auth()->id())
                                ->orderBy('date', 'desc')
                                ->limit(5)
                                ->get();
                        @endphp
                        
                        @if($recentTransactions->count() > 0)
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('M d, Y') }}</td>
                                    <td>{{ $transaction->category }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td class="text-danger">-${{ number_format($transaction->amount, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-info mt-3">
                            No transactions yet. <a href="{{ route('transactions.create') }}">Add your first expense</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>