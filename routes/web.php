<?php

use App\Http\Controllers\SlackController;
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

Route::get('/slack/index', [SlackController::class, 'index'])
    ->name('slack.index');

Route::post('/slack/post', [SlackController::class, 'create'])
    ->name('slack.post');

Route::get('/slack/complete/', [SlackController::class, 'complete'])
    ->name('slack.complete');
