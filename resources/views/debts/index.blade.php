@extends('layouts.app')

@section('title', 'Debts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Debt Records</h2>
    <a href="/debts/create" class="btn btn-primary">+ Add Debt</a>
</div>

@if($debts->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Creditor</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($debts as $debt)
                <tr>
                    <td><strong>{{ $debt->creditor_name }}</strong></td>
                    <td>${{ number_format($debt->amount, 2) }}</td>
                    <td>{{ $debt->due_date ? $debt->due_date->format('M d, Y') : 'N/A' }}</td>
                    <td>
                        <span class="badge bg-{{ $debt->status === 'paid' ? 'success' : ($debt->status === 'overdue' ? 'danger' : 'warning') }}">
                            {{ ucfirst($debt->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="/debts/{{ $debt->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/debts/{{ $debt->id }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $debts->links() }}
@else
    <div class="alert alert-info text-center">
        <p>No debt records yet. <a href="/debts/create">Create one now!</a></p>
    </div>
@endif
@endsection
