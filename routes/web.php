<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingsController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('dashboard');
});
Route::resource('/book', BookController::class);
Route::post('/book', [BookController::class, 'store'])->name('book.store');

Route::resource('/bookings', BookingsController::class);
