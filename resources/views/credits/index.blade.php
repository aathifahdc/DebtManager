@extends('layouts.app')

@section('title', 'Credits')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-primary">Credit Records</h2>
    <a href="/credits/create" class="btn btn-primary">+ Add Credit</a>
</div>

@if($credits->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Debtor</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($credits as $credit)
                <tr>
                    <td><strong>{{ $credit->debtor_name }}</strong></td>
                    <td>${{ number_format($credit->amount, 2) }}</td>
                    <td>{{ $credit->due_date ? $credit->due_date->format('M d, Y') : 'N/A' }}</td>
                    <td>
                        <span class="badge bg-{{ $credit->status === 'received' ? 'success' : ($credit->status === 'overdue' ? 'danger' : 'warning') }}">
                            {{ ucfirst($credit->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="/credits/{{ $credit->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                        <form action="/credits/{{ $credit->id }}" method="POST" style="display: inline;">
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
    {{ $credits->links() }}
@else
    <div class="alert alert-info text-center">
        <p>No credit records yet. <a href="/credits/create">Create one now!</a></p>
    </div>
@endif
@endsection
