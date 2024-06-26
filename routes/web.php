<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Response;
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

Route::post('/webhook', WebhookController::class)
    ->name('webhook.receive');

//Route::get('webhook', function () {
//    return response()->noContent(Response::HTTP_OK);
//})->name('get.trello');


