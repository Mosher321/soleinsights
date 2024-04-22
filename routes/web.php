<?php

use App\Http\Controllers\ShoeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ShoeController::class, 'home'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('add-shoe', [ShoeController::class, 'addShoe'])->name('shoe.add');
Route::get('get-shoe', [ShoeController::class, 'getShoe'])->name('shoe.get');
Route::get('submit-rating', [ShoeController::class, 'submitRating'])->name('rating.submit');
Route::get('submit-comment', [ShoeController::class, 'submitComment'])->name('rating.comment');
Route::get('hide-comment', [ShoeController::class, 'hideComment'])->name('hide.comment');
