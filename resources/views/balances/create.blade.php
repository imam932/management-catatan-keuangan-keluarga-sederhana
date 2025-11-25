<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Tambah Balance') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2 class="mb-4">Tambah Balance</h2>
        <form action="{{ route('balances.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    <option value="">Pilih User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="initial_balance" class="form-label">Tambah Saldo</label>
                <input type="number" step="0.01" name="initial_balance" id="initial_balance" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('balances.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</x-app-layout>
