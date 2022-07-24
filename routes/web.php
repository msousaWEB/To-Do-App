<?php

use App\Mail\MessageTestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
->name('home')
->middleware('verified');
Route::resource('task', 'App\Http\Controllers\TaskController')->middleware('verified');
Route::get('message-test', function() {
    return new MessageTestMail();
    // Mail::to('matheussousa2130@gmail.com')->send(new MessageTestMail());
    // return 'E-mail teste';
});
