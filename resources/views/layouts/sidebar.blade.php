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
    <li class="nav-item">
        <a href="{{ route('balances.index') }}" class="nav-link text-white">Balances</a>
    </li>
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-white btn btn-link" style="padding:0;">
                Logout
            </button>
        </form>
    </li>
</ul>