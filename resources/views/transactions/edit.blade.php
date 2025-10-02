<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Expense - Family Finance Tracker</title>
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
                            <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
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
                    <h2 class="mb-4">Edit Expense</h2>

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('transactions.update', $transaction) }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Select Category</option>
                                            <option value="Food" {{ old('category', $transaction->category) == 'Food' ? 'selected' : '' }}>Food</option>
                                            <option value="Transportation" {{ old('category', $transaction->category) == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                            <option value="Utilities" {{ old('category', $transaction->category) == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                                            <option value="Entertainment" {{ old('category', $transaction->category) == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                                            <option value="Healthcare" {{ old('category', $transaction->category) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                            <option value="Education" {{ old('category', $transaction->category) == 'Education' ? 'selected' : '' }}>Education</option>
                                            <option value="Shopping" {{ old('category', $transaction->category) == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                                            <option value="Other" {{ old('category', $transaction->category) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $transaction->description) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}" required>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Update Expense</button>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>