<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balance Histories') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2 class="mb-4">History Perubahan Balance</h2>
        <a href="{{ route('balances.index') }}" class="btn btn-secondary mb-3">Kembali ke Balance</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr>
                    <td>{{ $history->created_at }}</td>
                    <td>Rp{{ number_format($history->amount, 2) }}</td>
                    <td>{{ ucfirst($history->type) }}</td>
                    <td>{{ $history->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
