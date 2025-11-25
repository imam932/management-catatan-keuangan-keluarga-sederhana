<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Edit Balance') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2 class="mb-4">Edit Balance</h2>
        <form action="{{ route('balances.update', $balance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" disabled>
                    <option value="{{ $balance->user->id }}">{{ $balance->user->name }}</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="initial_balance" class="form-label">Saldo Awal</label>
                <input type="number" step="0.01" name="initial_balance" id="initial_balance" class="form-control" value="{{ $balance->initial_balance }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('balances.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>
