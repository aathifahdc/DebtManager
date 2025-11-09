@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Debts</h6>
                <h3 class="text-danger fw-bold">${{ number_format($totalDebts, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-muted">Debts Paid</h6>
                <h3 class="text-success fw-bold">${{ number_format($totalDebtsPaid, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-muted">Total Credits</h6>
                <h3 class="text-info fw-bold">${{ number_format($totalCredits, 2) }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm border-0">
            <div class="card-body">
                <h6 class="card-title text-muted">Credits Received</h6>
                <h3 class="text-success fw-bold">${{ number_format($totalCreditsReceived, 2) }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- GRAFIK -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-light fw-bold">
        Financial Overview
    </div>
    <div class="card-body">
        <canvas id="financeChart" height="100"></canvas>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white fw-bold">
                Recent Debts
            </div>
            <div class="card-body">
                @if($recentDebts->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentDebts as $debt)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $debt->creditor_name }}</strong>
                                <br>
                                <small class="text-muted">{{ $debt->due_date ? $debt->due_date->format('M d, Y') : 'No date' }}</small>
                            </div>
                            <span class="badge bg-danger">${{ number_format($debt->amount, 2) }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center">No recent debts.</p>
                @endif
                <a href="/debts" class="btn btn-sm btn-primary mt-3 w-100">View All Debts</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white fw-bold">
                Recent Credits
            </div>
            <div class="card-body">
                @if($recentCredits->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentCredits as $credit)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $credit->debtor_name }}</strong>
                                <br>
                                <small class="text-muted">{{ $credit->due_date ? $credit->due_date->format('M d, Y') : 'No date' }}</small>
                            </div>
                            <span class="badge bg-success">${{ number_format($credit->amount, 2) }}</span>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center">No recent credits.</p>
                @endif
                <a href="/credits" class="btn btn-sm btn-info mt-3 w-100">View All Credits</a>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT GRAFIK -->
<script>
const ctx = document.getElementById('financeChart').getContext('2d');
const financeChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Debts', 'Debts Paid', 'Total Credits', 'Credits Received'],
        datasets: [{
            label: 'Amount ($)',
            data: [
                {{ $totalDebts }},
                {{ $totalDebtsPaid }},
                {{ $totalCredits }},
                {{ $totalCreditsReceived }}
            ],
            backgroundColor: ['#dc3545', '#198754', '#0dcaf0', '#20c997'],
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Debt & Credit Summary',
                font: { size: 16, weight: 'bold' }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
@endsection
