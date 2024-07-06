<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\CalenderController;
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
    return view('user_lvl_calender');
});
Route::get('/dialog', function () {
    return view('dialog');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::get('/events', [FullCalenderController::class, 'showEvents'])->name('events.show');

Route::get('/admin/event/read', [EventController::class, 'read'])->name('admin.event.read');

require __DIR__.'/auth.php';




Route::get('/', function () {
    return view('welcome');
});

Route::match(['put', 'post'], '/events/update/{id}', [App\Http\Controllers\EventController::class, 'update'])->name('update_events');

// Route::get('full-calender', [FullCalenderController::class, 'admin_cal'])->name('admin_view');
Route::get('full-calender', [FullCalenderController::class, 'admin_cal'])->name('admin_view')->middleware('calguard');
Route::get('full-calender-test', [FullCalenderController::class, 'admin_cal_test'])->name('admin_view_test')->middleware('calguard');
Route::get('/calendar', [FullCalenderController::class, 'homepagecal'])->name('admin_view_homepagecal')->middleware('calguard');
Route::get('/cal_operation', [FullCalenderController::class, 'open_cal_operation'])->name('cal_operation')->middleware('calguard');

Route::post('full-calender/action', [FullCalenderController::class, 'action']);

Route::post('/full-calender', [FullCalenderController::class, 'store_events'])->name('store_events');

Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');



// Define the events.index route
Route::get('/events', [EventController::class, 'index'])->name('events.index');


Route::get('/fulluser', [EventController::class, 'getEvents']);

Route::get('/filter_events', [EventController::class, 'filterEvents'])->name('filter_events');;
