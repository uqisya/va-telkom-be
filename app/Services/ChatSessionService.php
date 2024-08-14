<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ChatSessionService
{

    private $chatService;
    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function getAllChatSessions()
    {
        $chatSessionsData = DB::select(
            'SELECT id, title, created_at
            FROM chat_sessions'
        );
        return $chatSessionsData;
    }

    public function startNewChatSession()
    {
        DB::insert(
            'INSERT INTO chat_sessions (title)
            VALUES (:title)
            ',
            [
                'title' => null
            ]
        );

        $chatSessionID = DB::getPdo()->lastInsertId();
        $currentChatSessionData = DB::selectOne(
            'SELECT id, title, created_at
            FROM chat_sessions
            WHERE id = :chat_session_id',
            [
                'chat_session_id' => $chatSessionID
            ]
        );

        $fullname = "Telkom Indonesia";
        $message = "Hai! Ada yang bisa saya bantu?";

        $this->chatService->createNewMessage($chatSessionID, $fullname, $message);

        return $currentChatSessionData;
    }
}
