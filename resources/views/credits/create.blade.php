@extends('layouts.app')

@section('title', 'Add Credit')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4 fw-bold text-primary">Add New Credit Record</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form method="POST" action="/credits">
                    @csrf

                    <div class="mb-3">
                        <label for="debtor_name" class="form-label fw-bold">Debtor Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('debtor_name') is-invalid @enderror" id="debtor_name" name="debtor_name" value="{{ old('debtor_name') }}" required>
                        @error('debtor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label fw-bold">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" step="0.01" value="{{ old('amount') }}" required>
                        </div>
                        @error('amount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label fw-bold">Due Date</label>
                        <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}">
                        @error('due_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="received" {{ old('status') === 'received' ? 'selected' : '' }}>Received</option>
                            <option value="overdue" {{ old('status') === 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Add Credit</button>
                        <a href="/credits" class="btn btn-secondary fw-bold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
