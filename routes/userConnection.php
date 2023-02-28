<?php
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->controller(RequestController::class)->group(function () {
    Route::get('/home', [RequestController::class, 'index'])->name('home');
    Route::post('/get-suggesstions', [RequestController::class, 'getSuggesstions'])->name('getSuggesstions');
    Route::post('/get-sent-request', [RequestController::class, 'getSentRequest'])->name('getSentRequest');
    Route::post('/get-receive-request', [RequestController::class, 'getReceiveRequest'])->name('getReceiveRequest');
    Route::post('/get-connected', [RequestController::class, 'getConnected'])->name('getConnected');
    Route::post('/send-request', [RequestController::class, 'sendRequest'])->name('sendRequest');
    Route::post('/withdraw-request', [RequestController::class, 'withdrawRequest'])->name('withdrawRequest');
    Route::post('/accept-request', [RequestController::class, 'acceptRequest'])->name('acceptRequest');
    Route::post('/cancel-request', [RequestController::class, 'cancelRequest'])->name('cancelRequest');
    Route::post('/get-common', [RequestController::class, 'getCommon'])->name('getCommon');

});
