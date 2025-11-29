<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Transaction') }}
        </h2>
    </x-slot>
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
                            <option value="Saving" {{ old('category') == 'Saving' ? 'selected' : '' }}>Saving</option>
                            <option value="Food" {{ old('category', $transaction->category) == 'Food' ? 'selected' : '' }}>Food</option>
                            <option value="Transportation" {{ old('category', $transaction->category) == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                            <option value="Utilities" {{ old('category', $transaction->category) == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                            <option value="Entertainment" {{ old('category', $transaction->category) == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                            <option value="Healthcare" {{ old('category', $transaction->category) == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                            <option value="Education" {{ old('category', $transaction->category) == 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Shopping" {{ old('category', $transaction->category) == 'Shopping' ? 'selected' : '' }}>Shopping</option>
                            <option value="Social" {{ old('category', $transaction->category) == 'Social' ? 'selected' : '' }}>Social</option>
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
</x-app-layout>