@extends('layouts.userdash')

@section('title', 'Dashboard')

@section('content')
<h2>Library Dashboard</h2>
<p class="text-muted">View the total number of users and books.</p>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card text-bg-warning">
            <div class="card-body">
                <h5>Total Users</h5>
                <h2>{{ $usercount }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card text-bg-dark">
            <div class="card-body">
                <h5>Total Books</h5>
                <h2>{{ $bookcount }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">System Data</h5>
                <div class="chart-box">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">Books by Category</h5>
                <div class="chart-box">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Users', 'Books'],
            datasets: [{
                label: 'System Data',
                data: [{{ $usercount }}, {{ $bookcount }}],
                backgroundColor: ['#ffc107', '#212529'],
                borderColor: ['#ffc107', '#212529'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const categoryCtx = document.getElementById('categoryChart');

    new Chart(categoryCtx, {
        type: 'doughnut',
        data: {
            labels: @json($booksByCategory->pluck('category')),
            datasets: [{
                label: 'Books by Category',
                data: @json($booksByCategory->pluck('total')),
                backgroundColor: [
                    '#ffc107',
                    '#212529',
                    '#0d6efd',
                    '#198754',
                    '#dc3545',
                    '#6f42c1',
                    '#795548'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection