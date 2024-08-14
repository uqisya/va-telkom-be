<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Services\ChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
    ChatController -> class untuk menghandle request API terkait Chat
    - getAllChatByChatSessionID -> method untuk mendapatkan semua chat berdasarkan chat session id
    - createNewMessage -> method untuk membuat pesan baru dalam chat session
*/

class ChatController
{

    private $apiResponse;
    private $chatService;

    public function __construct(ApiResponseHelper $apiResponse, ChatService $chatService)
    {
        $this->apiResponse = $apiResponse;
        $this->chatService = $chatService;
    }

    // check apakah chat session id ada
    private function checkChatSessionExist($chatSessionID)
    {
        try {
            // cek apakah chat session id ada
            $this->chatService->isChatSessionExist($chatSessionID);
        } catch (\Exception $e) {
            Log::error('Error occurred in isChatSessionExist chatService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: $e->getMessage(),
                errors: [],
                codeResponse: 404,
            );
        }
    }

    // method untuk mendapatkan semua chat berdasarkan chat session id
    public function getAllChatByChatSessionID($chatSessionID)
    {
        // check apakah chat session id ada
        $response = $this->checkChatSessionExist($chatSessionID);
        if ($response) {
            return $response;
        }

        try {
            // return array object chat
            $allChatData = $this->chatService->getAllChatByChatSessionID($chatSessionID);
        } catch (\Exception $e) {
            Log::error('Error occurred in getAllChatByChatSessionID chatService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: "Failed to get all chat.",
                errors: [],
                codeResponse: 500,
            );
        }

        return $this->apiResponse->successResponse(
            message: "Success get all chat.",
            data: ChatResource::collection($allChatData),
            codeResponse: 200,
        );
    }

    // method untuk membuat pesan baru dalam chat session
    public function createNewMessage($chatSessionID, ChatRequest $request)
    {
        // check apakah chat session id ada, return response API
        $response = $this->checkChatSessionExist($chatSessionID);
        if ($response) {
            return $response;
        }

        // return request yang sudah divalidasi berupa array
        $chatData = $request->validated();

        try {
            $chatClientData = $this->chatService->createNewMessage($chatSessionID, $chatData['fullname'], $chatData['message']);
        } catch (\Exception $e) {
            Log::error('Error occurred in createNewMessage chatService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: "Failed to create new message.",
                errors: [],
                codeResponse: 500,
            );
        }

        try {
            // reply chat, return string
            $responseReply = $this->chatService->replyChat($chatClientData->message);
        } catch (\Exception $e) {
            Log::error('Error occurred in replyChat chatService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: "Failed to reply user question.",
                errors: [],
                codeResponse: 500,
            );
        }

        try {
            // create new message, return array object chat
            $chatAssistantData = $this->chatService->createNewMessage($chatSessionID, "Telkom Indonesia", $responseReply);
        } catch (\Exception $e) {
            Log::error('Error occurred in createNewMessage chatService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: "Failed to create new message.",
                errors: [],
                codeResponse: 500,
            );
        }

        return $this->apiResponse->successResponse(
            message: "Success reply user question.",
            data: new ChatResource($chatAssistantData),
            codeResponse: 200,
        );
    }
}
