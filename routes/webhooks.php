<?php

use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WebhooksController;
use App\Http\Middleware\VerifyTrelloIPsMiddleware;
use App\Http\Middleware\VerifyTrelloWebhookSignatureMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

// trello submits get request upon webhook creation to verify callbackURL endpoint
Route::get('trello', function () {
        return response()->noContent(Response::HTTP_OK);
    })->name('get.trello');

// for all consecutive webhooks request trello uses POST
Route::post('trello', WebhooksController::class

        // ideally a job is dispatched here and OK status is returned straight away

//        return response()->noContent(Response::HTTP_OK);
    )->name('post.trello');

