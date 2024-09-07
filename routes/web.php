<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BikeController;
use App\Http\Controllers\OrderController;
use App\Jobs\TestJob;

Route::get('/bikes', [BikeController::class, 'index'])->name('bikes.index');
Route::get('/bikes/create', [BikeController::class, 'create'])->name('bikes.create');
Route::post('/bikes', [BikeController::class, 'store'])->name('bikes.store');
Route::get('/bikes/{bike}', [BikeController::class, 'show'])->name('bikes.show');
Route::get('/bikes/{bike}/edit', [BikeController::class, 'edit'])->name('bikes.edit');
Route::put('/bikes/{bike}', [BikeController::class, 'update'])->name('bikes.update');
Route::delete('/bikes/{bike}', [BikeController::class, 'destroy'])->name('bikes.destroy');


Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::post('/orders/create', [OrderController::class, 'store'])->name('orders.store');


Route::get('/', [BikeController::class, 'index'])->name('home');



Route::get('/dispatch-test-job', function () {
    TestJob::dispatch();
    return 'Test job dispatched!';
});

Route::prefix('api')->group(function () {
    Route::get('/bikes', [BikeController::class, 'apiIndex']);
});
