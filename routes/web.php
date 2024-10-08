<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [\App\Http\Controllers\PublicationController::class, 'index']);

Route::resource('/publicationsInternal', \App\Http\Controllers\InternalPublicationController::class);

Route::resource('/offersInternal', \App\Http\Controllers\OfferController::class);

Route::get('/publications', [\App\Http\Controllers\PublicationController:: class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
