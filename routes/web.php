<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/utang', function () {
    return 'Halaman Utang';
})->name('utang.index');

Route::get('/piutang', function () {
    return 'Halaman Piutang';
})->name('piutang.index');

Route::get('/login', function () {
    return 'Halaman Login';
})->name('login.form');

Route::get('/register', function () {
    return 'Halaman Register';
})->name('register.form');
