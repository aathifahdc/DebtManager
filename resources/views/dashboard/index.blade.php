@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="text-primary mb-4">Welcome, {{ Auth::user()->name }}! 👋</h1>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Debts</p>
                        <h3 class="text-danger">₱{{ number_format($totalDebts, 2) }}</h3>
                    </div>
                    <span class="text-danger fs-3">💳</span>
                </div>
                <p class="text-muted small mb-0">{{ $unpaidDebtsCount }} unpaid</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Credits</p>
                        <h3 class="text-success">₱{{ number_format($totalCredits, 2) }}</h3>
                    </div>
                    <span class="text-success fs-3">💰</span>
                </div>
                <p class="text-muted small mb-0">{{ $unpaidCreditsCount }} unpaid</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Net Balance</p>
                        <h3 class="@if(($totalCredits - $totalDebts) >= 0) text-success @else text-danger @endif">
                            ₱{{ number_format(abs($totalCredits - $totalDebts), 2) }}
                        </h3>
                    </div>
                    <span class="fs-3">⚖️</span>
                </div>
                <p class="text-muted small mb-0">
                    @if(($totalCredits - $totalDebts) >= 0) You're owed @else You owe @endif
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted mb-1 small">Total Records</p>
                        <h3 class="text-primary">{{ count($recentDebts) + count($recentCredits) }}</h3>
                    </div>
                    <span class="text-primary fs-3">📋</span>
                </div>
                <p class="text-muted small mb-0">Debts & Credits</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 text-primary">Recent Debts</h5>
            </div>
            <div class="card-body p-0">
                @forelse($recentDebts as $debt)
                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 fw-bold">{{ $debt->creditor_name }}</p>
                            <p class="text-muted small mb-0">{{ $debt->due_date?->format('M d, Y') ?? 'No due date' }}</p>
                        </div>
                        <div class="text-end">
                            <p class="mb-1 fw-bold text-danger">₱{{ number_format($debt->amount, 2) }}</p>
                            <span class="badge bg-{{ $debt->getStatusBadgeClass() }}">{{ ucfirst($debt->status) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="p-3 mb-0 text-muted text-center">No debts recorded yet</p>
                @endforelse
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('debts.index') }}" class="btn btn-sm btn-outline-primary w-100">View All Debts</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0 text-success">Recent Credits</h5>
            </div>
            <div class="card-body p-0">
                @forelse($recentCredits as $credit)
                    <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1 fw-bold">{{ $credit->debtor_name }}</p>
                            <p class="text-muted small mb-0">{{ $credit->due_date?->format('M d, Y') ?? 'No due date' }}</p>
                        </div>
                        <div class="text-end">
                            <p class="mb-1 fw-bold text-success">₱{{ number_format($credit->amount, 2) }}</p>
                            <span class="badge bg-{{ $credit->getStatusBadgeClass() }}">{{ ucfirst($credit->status) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="p-3 mb-0 text-muted text-center">No credits recorded yet</p>
                @endforelse
            </div>
            <div class="card-footer bg-white">
                <a href="{{ route('credits.index') }}" class="btn btn-sm btn-outline-success w-100">View All Credits</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12 text-center">
        <a href="{{ route('debts.create') }}" class="btn btn-primary me-2">+ Add Debt</a>
        <a href="{{ route('credits.create') }}" class="btn btn-success">+ Add Credit</a>
    </div>
</div>
@endsection