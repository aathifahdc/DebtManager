@extends('layouts.app')

@section('title', '404 Not Found')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <h1 class="display-1 text-danger fw-bold">404</h1>
        <h2 class="mb-4">Page Not Found</h2>
        <p class="text-muted mb-4">Sorry, the page you're looking for doesn't exist.</p>
        <a href="/dashboard" class="btn btn-primary">Go to Dashboard</a>
    </div>
</div>
@endsection
