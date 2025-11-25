<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Balances') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2 class="mb-4">Daftar Balance</h2>
        <a href="{{ route('balances.create') }}" class="btn btn-primary mb-3">Tambah Balance</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Saldo Awal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($balances as $balance)
                <tr>
                    <td>{{ $balance->id }}</td>
                    <td>{{ $balance->user->name ?? '-' }}</td>
                    <td>Rp{{ number_format($balance->initial_balance, 2) }}</td>
                    <td>
                        <a href="{{ route('balances.edit', $balance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('balances.destroy', $balance->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus balance?')">Hapus</button>
                        </form>
                        <a href="{{ route('balance-histories.index', ['balance_id' => $balance->id]) }}" class="btn btn-sm btn-info">History</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
