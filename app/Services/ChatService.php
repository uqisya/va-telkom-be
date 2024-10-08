<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ChatService
{

    public function isChatSessionExist($chatSessionID)
    {
        $chatSession = DB::selectOne(
            'SELECT id
            FROM chat_sessions
            WHERE id = :chat_session_id
            ',
            [
                'chat_session_id' => $chatSessionID
            ]
        );
        if ($chatSession === null) {
            throw new \Exception("Chat session not found.");
        }
    }

    public function getAllChatByChatSessionID($chatSessionID)
    {
        $allChat = DB::select(
            'SELECT id, chat_session_id, fullname, message, created_at
            FROM chats
            WHERE chat_session_id = :chat_session_id
            ',
            [
                'chat_session_id' => $chatSessionID
            ]
        );

        return $allChat;
    }

    public function createNewMessage($chatSessionID, $fullname, $message)
    {
        DB::insert(
            'INSERT INTO chats (chat_session_id, fullname, message)
            VALUES (:chat_session_id, :fullname, :message)
            ',
            [
                'chat_session_id' => $chatSessionID,
                'fullname' => $fullname,
                'message' => $message,
            ]
        );

        $chatID = DB::getPdo()->lastInsertId();
        $currentChatData = DB::selectOne(
            'SELECT id, chat_session_id, fullname, message, created_at
            FROM chats
            WHERE id = :chat_id',
            [
                'chat_id' => $chatID
            ]
        );

        return $currentChatData;
    }

    public function replyChat($question)
    {
        $chatDataAnswer = DB::selectOne(
            'SELECT f.answer
            FROM chats AS c
            INNER JOIN faqs AS f ON c.message = f.question
            WHERE f.question LIKE :question
            LIMIT 1
            ',
            [
                'question' => '%' . $question . '%'
            ]
        );

        if ($chatDataAnswer === null) {
            return "Maaf saya tidak mengenali maksud anda.";
        }

        return $chatDataAnswer->answer;
    }
}
