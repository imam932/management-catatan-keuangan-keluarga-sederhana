<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Family Finance Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                            <a href="{{ route('reports.index') }}" class="nav-link active">Reports</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-md-10">
                <div class="p-4">
                    <h2 class="mb-4">Monthly Reports</h2>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Monthly Expenses</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Expenses by Category</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="categoryChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Monthly Summary</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Year</th>
                                        <th>Total Expenses</th>
                                        <th>Number of Transactions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthlyData as $data)
                                    <tr>
                                        <td>{{ date('F', mktime(0, 0, 0, $data->month, 1)) }}</td>
                                        <td>{{ $data->year }}</td>
                                        <td class="text-danger">-${{ number_format($data->total, 2) }}</td>
                                        <td>{{ $data->count }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const monthlyData = @json($monthlyData->map(function($item) {
            return [
                'label' => new Date($item.year, $item.month - 1).toLocaleString('default', { month: 'short', year: '2-digit' }),
                'total' => $item.total
            ];
        }));

        const categoryData = @json($categories->map(function($item) {
            return [
                'label' => $item.category,
                'total' => $item.total
            ];
        }));

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: monthlyData.map(item => item.label),
                datasets: [{
                    label: 'Monthly Expenses',
                    data: monthlyData.map(item => item.total),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: categoryData.map(item => item.label),
                datasets: [{
                    data: categoryData.map(item => item.total),
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#C9CBCF'
                    ]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>