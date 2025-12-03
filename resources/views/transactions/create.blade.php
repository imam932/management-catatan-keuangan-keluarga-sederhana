<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Expense') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                            <option value="Transportation" {{ old('category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                            <option value="Utilities" {{ old('category') == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                            <option value="Entertainment" {{ old('category') == 'Entertainment' ? 'selected' : '' }}>Entertainment</option>
                            <option value="Selfcare" {{ old('category') == 'Selfcare' ? 'selected' : '' }}>Selfcare</option>
                            <option value="Education" {{ old('category') == 'Education' ? 'selected' : '' }}>Education</option>
                            <option value="Jajanzahra" {{ old('category') == 'Jajanzahra' ? 'selected' : '' }}>Jajan Zahra</option>
                            <option value="Social" {{ old('category') == 'Social' ? 'selected' : '' }}>Social</option>
                            <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Add Expense</button>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>