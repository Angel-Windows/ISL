<?php

use App\Http\Controllers\PageControler;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\UserController;
use App\Helpers\Telegram;
use App\Http\Controllers\AdminController;

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
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//test
Route::get('/test', [CalendarController::class, 'lesson_info_event'])->name('test');

//Page
Route::get('/', function () {
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


Route::get('/bot', function (Telegram $telegram) {
    $key = base64_encode(md5(uniqid()));
    $buttons = [
        'inline_keyboard' => [
            [
                [
                    'text' => 'button1',
                    'callback_data' => '1|' . $key
                ],
                [
                    'text' => 'button1sss',
                    'callback_data' => '1' . $key,

                ],
            ]
        ]
    ];
//    $telegram = new Telegram();
    $sendButton = $telegram->get_button(env('REPORT_TELEGRAM_ID', "324428256"), 'test', $buttons);
//    $telegram->send_message(324428256,'sdsdss');
})->name('transaction.get_info');

Route::get('/payed', [PageControler::class, "payed"])->name('payed');
Route::post('/payed/store', [TransactionController::class, "payed_store"])->name('payed.store');


Route::get('/crone', [AdminController::class, "crone"])->name('crone');

Route::post('/webhook', [AdminController::class, "webhook"])->name('webhook');




require __DIR__ . '/auth.php';
