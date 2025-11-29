<!-- Desktop sidebar (visible md+) -->
<div class="d-none d-md-block">
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
</div>

<!-- Mobile sidebar toggle (visible on small screens) -->
<div class="d-md-none mb-3">
    <button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
        ☰ Menu
    </button>
</div>

<!-- Mobile offcanvas sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title" id="mobileSidebarLabel">Family Finance</h5>
        <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <ul class="nav nav-pills flex-column p-3">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transactions.index') }}" class="nav-link">Transactions</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('reports.index') }}" class="nav-link">Reports</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('balances.index') }}" class="nav-link">Balances</a>
            </li>
            <li class="nav-item mt-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>