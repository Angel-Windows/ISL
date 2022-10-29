<?php

use App\Http\Controllers\PageControler;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TransactionController;
use App\Models\User;
use App\Models\UsersProfile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\UserController;
use App\Helpers\Telegram;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebhookController;

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
Route::get('/dashboard', function () {
    return redirect()->route('home');
//    Http::post(route('login'), [
//        'email' => 'eliphas.sn@gmail.com',
//        'password' => '1232',
//    ]);
//    return view('dashboard');
});


Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//test
Route::get('/test', [CalendarController::class, 'lesson_info_event'])->name('test');

//Page
Route::get('/', function () {
    return redirect(\route('home'));
});
Route::get('/home', [PageControler::class, 'home'])->name('home');
//Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/calendar', [PageControler::class, 'calendar'])->name('calendar')->middleware('auth');

//AJAX
Route::post('/calendar/filters', [GlobalController::class, 'ajax_filters'])->name('calendar.filters_calendar');
Route::middleware(['auth', 'check-role'])->group(function () {
    Route::get('/transaction', [PageControler::class, 'transaction'])->name('transaction');

    Route::post('/calendar/lesson_info_event', [CalendarController::class, 'lesson_info_event'])->name('calendar.lesson_info_event');
    Route::post('/calendar/add_lesson', [CalendarController::class, 'add_lesson'])->name('calendar.add_lesson');
    Route::get('/transaction/info', [TransactionController::class, 'get_info'])->name('transaction.get_info');
    Route::post('/transaction/transaction_info_event', [TransactionController::class, 'transaction_info_event'])->name('transaction.transaction_info_event');
    Route::get('/payed', [PageControler::class, "payed"])->name('payed');
    Route::post('/payed/store', [TransactionController::class, "payed_store"])->name('payed.store');
    Route::get('/setWebhook', [AdminController::class, "setWebhook"])->name('setWebhook');
    Route::get('/admin/create_student', [PageControler::class, "create_student"])->name('admin.create_student');
    Route::post('/admin/create_student_store', [AdminController::class, "create_student_store"])->name('admin.create_student_store');
});
Route::post('/calendar/get_lesson_info', [CalendarController::class, 'get_lesson_info'])->name('calendar.get_lesson_info');


Route::get('/bot', function (Telegram $telegram) {
})->name('transaction.get_info');

//Admin

Route::get('/crone', [AdminController::class, "crone"])->name('crone');
Route::post('/webhook', [WebhookController::class, "index"])->name('webhook');


require __DIR__ . '/auth.php';
