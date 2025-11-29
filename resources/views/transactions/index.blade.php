<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>
    <div class="col-md-10">
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('transactions.create') }}" class="btn btn-primary">Add New Expense</a>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->date->format('M d, Y') }}</td>
                                <td>{{ $transaction->category }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td class="text-danger">-Rp{{ number_format($transaction->amount, 2) }}</td>
                                <td>
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>