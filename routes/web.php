<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FullCalenderController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/testing', function () {
    return view('testing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin/event/read', [EventController::class, 'read'])->name('admin.event.read');

require __DIR__.'/auth.php';




Route::get('/', function () {
    return view('welcome');
});

// Route::get('full-calender', [FullCalenderController::class, 'admin_cal'])->name('admin_view');
Route::get('full-calender', [FullCalenderController::class, 'admin_cal'])->name('admin_view')->middleware('calguard');
Route::post('full-calender/action', [FullCalenderController::class, 'action']);

Route::post('/full-calender', [FullCalenderController::class, 'store_events'])->name('store_events');
