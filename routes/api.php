<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ChatSessionController;
use App\Http\Controllers\Api\FaqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('faqs', [FaqController::class, 'getAllFaq']);

Route::group(['prefix' => 'chats'], function () {
    Route::get('/', [ChatSessionController::class, 'getAllChatSessions']);
    Route::post('/', [ChatSessionController::class, 'startNewChatSession']);

    Route::get('/{chatSessionID}', [ChatController::class, 'getFirstChatByChatSessionID']);
    Route::post('/{chatSessionID}', [ChatController::class, 'createNewMessage']);
});
