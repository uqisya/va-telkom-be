<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ChatSessionController;
use App\Http\Controllers\Api\FaqController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

// get all faqs
Route::get('faqs', [FaqController::class, 'getAllFaq']);

// router for chat
Route::group(['prefix' => 'chats'], function () {
    // get all chat sessions
    Route::get('/', [ChatSessionController::class, 'getAllChatSessions']);
    // start new chat session
    Route::post('/', [ChatSessionController::class, 'startNewChatSession']);

    // get all chat by chat session id
    Route::get('/{chatSessionID}', [ChatController::class, 'getAllChatByChatSessionID']);
    // create new message in the chat session
    Route::post('/{chatSessionID}', [ChatController::class, 'createNewMessage']);
});

// Route::get('/openai', function () {
//     $result = OpenAI::chat()->create([
//         'model' => 'gpt-3.5-turbo',
//         'messages' => [
//             [
//                 'role' => 'user',
//                 'content' => ''
//             ],
//         ],
//     ]);

//     echo $result->choices[0]->message->content;
// });
