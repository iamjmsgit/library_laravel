@extends('layouts.userdash')

@section('title', 'Dashboard')

@section('content')
<h2>Library Dashboard</h2>
<p class="text-muted">Manage books, users, and borrowed records here.</p>

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
        <canvas id="myChart"></canvas>
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
    }
});
</script>
@endsection