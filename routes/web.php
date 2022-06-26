<?php

use App\Http\Controllers\PageControler;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GlobalController;
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
Route::get('/test', [CalendarController::class, 'lesson_info_event'])->name('test');

//Page
Route::get('/rozetka', function (){
    return view('welcome');
})->name('rozetka');
Route::get('/', function (){
    return redirect(\route('home'));
});
Route::get('/home', [PageControler::class, 'home'])->name('home')->middleware('auth');
//Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/calendar', [PageControler::class, 'calendar'])->name('calendar')->middleware('auth');
Route::get('/transaction', [PageControler::class, 'transaction'])->name('transaction')->middleware('auth');

//AJAX
Route::post('/calendar/filters', [GlobalController::class, 'ajax_filters'])->name('calendar.filters_calendar');
Route::post('/calendar/add_lesson', [CalendarController::class, 'add_lesson'])->name('calendar.add_lesson');
Route::post('/calendar/lesson_info_event', [CalendarController::class, 'lesson_info_event'])->name('calendar.lesson_info_event');
Route::post('/calendar/get_lesson_info', [CalendarController::class, 'get_lesson_info'])->name('calendar.get_lesson_info');

Route::get('/transaction/info', [TransactionController::class, 'get_info'])->name('transaction.get_info')->middleware('auth');
Route::post('/transaction/transaction_info_event', [TransactionController::class, 'transaction_info_event'])->name('transaction.transaction_info_event');

require __DIR__ . '/auth.php';
