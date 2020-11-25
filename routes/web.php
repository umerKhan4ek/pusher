<?php

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


Route::get('/notification', 'App\Http\Controllers\PusherNotificationController@sendNotification');

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});

route::get('submit', 'App\Http\Controllers\PusherNotificationController@showBtn')->name('formsubmit1');
route::post('/submit', 'App\Http\Controllers\PusherNotificationController@sendMessage')->name('formsubmit');

route::get('list','App\Http\Controllers\PusherNotificationController@showlist');

route::post('count','App\Http\Controllers\PusherNotificationController@sendMessage')->name('counter.count');