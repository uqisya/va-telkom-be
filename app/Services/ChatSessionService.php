<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/*
    ChatSessionService -> class untuk menghandle query/business logic terkait ChatSession
    - getAllChatSessions -> method untuk mendapatkan semua list chat sessions
    - startNewChatSession -> method untuk membuat chat session baru, create new message, kemudian return chat session yang baru dibuat
*/

class ChatSessionService
{

    // butuh ChatService untuk membuat message pertama saat startNewChatSession
    private $chatService;
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    // method untuk mendapatkan semua list chat sessions
    public function getAllChatSessions()
    {
        $chatSessionsData = DB::select(
            'SELECT id, title, created_at
            FROM chat_sessions
            ORDER BY id DESC
            '
        );
        return $chatSessionsData;
    }

    // method untuk membuat chat session baru, create new message, kemudian return chat session yang baru dibuat
    public function startNewChatSession()
    {
        // get last session id
        $lastSession = DB::selectOne(
            'SELECT id
            FROM chat_sessions
            ORDER BY id DESC
            LIMIT 1'
        );

        // generate new title
        $newTitle = $lastSession ? "Session " . $lastSession->id + 1 : "Session 1";

        // insert new chat session
        DB::insert(
            'INSERT INTO chat_sessions (title)
            VALUES (:title)
            ',
            [
                'title' => $newTitle
            ]
        );

        // get last inserted chat session id
        $currentChatSessionID = DB::getPdo()->lastInsertId();
        // get chat session data from current chat session id
        $currentChatSessionData = DB::selectOne(
            'SELECT id, title, created_at
            FROM chat_sessions
            WHERE id = :chat_session_id',
            [
                'chat_session_id' => $currentChatSessionID
            ]
        );

        $fullname = "Telkom Indonesia";
        $message = "Hai! Ada yang bisa saya bantu?";

        // create new message in the chat session
        $this->chatService->createNewMessage($currentChatSessionID, $fullname, $message);

        // return chat session object yang baru dibuat
        return $currentChatSessionData;
    }
}
