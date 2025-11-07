@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="text-center">
    <h1 class="fw-bold mb-3 text-primary">Selamat Datang di Aplikasi DebtManager</h1>
    <p class="text-muted">Catat dan kelola utang serta piutangmu dengan aman dan efisien.</p>

    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">📘 Data Utang</h5>
                    <p class="text-muted small">Catat semua utang yang kamu miliki.</p>
                    <a href="{{ route('utang.index') }}" class="btn btn-primary btn-sm w-100">Lihat Utang</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold">📗 Data Piutang</h5>
                    <p class="text-muted small">Pantau siapa yang berutang kepadamu.</p>
                    <a href="{{ route('piutang.index') }}" class="btn btn-success btn-sm w-100">Lihat Piutang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
