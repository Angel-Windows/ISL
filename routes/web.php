<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;

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
auth();
//test
Route::get('/test', [CalendarController::class, 'ajax_filters'])->name('test');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//Page
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar')->middleware('auth');
Route::get('/progress', [CalendarController::class, 'index'])->name('progress')->middleware('auth');



//AJAX
Route::post('/calendar/filters', [CalendarController::class, 'ajax_filters'])->name('calendar.filters');
Route::post('/calendar/add_lesson', [CalendarController::class, 'add_lesson'])->name('calendar.add_lesson');
require __DIR__ . '/auth.php';
