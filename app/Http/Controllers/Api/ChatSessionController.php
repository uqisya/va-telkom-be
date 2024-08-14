<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\ChatSessionResource;
use App\Services\ChatSessionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
    ChatSessionController -> class untuk menghandle request API terkait ChatSession
    - getAllChatSessions -> method untuk mendapatkan semua list chat sessions
    - startNewChatSession -> method untuk membuat chat session baru, kemudian return chat session yang baru dibuat
*/

class ChatSessionController
{

    private $apiResponse;
    private $chatSessionService;

    public function __construct(ApiResponseHelper $apiResponse, ChatSessionService $chatSessionService)
    {
        $this->apiResponse = $apiResponse;
        $this->chatSessionService = $chatSessionService;
    }

    // method untuk mendapatkan semua list chat sessions
    public function getAllChatSessions()
    {
        try {
            // return array object chat sessions
            $chatSessionsData = $this->chatSessionService->getAllChatSessions();
        } catch (\Exception $e) {
            Log::error('Error occurred in getAllChatSessions chatSessionService', [
                'exception' => $e->getMessage(),
            ]);
            return $this->apiResponse->errorResponse(
                message: "Failed get all chat sessions.",
                errors: [],
                codeResponse: 500,
            );
        }

        return $this->apiResponse->successResponse(
            message: "Success get all chat sessions.",
            data: ChatSessionResource::collection($chatSessionsData),
            codeResponse: 200,
        );
    }

    // method untuk membuat chat session baru, kemudian return chat session yang baru dibuat
    public function startNewChatSession()
    {
        try {
            // return chat session object yang baru dibuat
            $currentSessionData = $this->chatSessionService->startNewChatSession();
        } catch (\Exception $e) {
            Log::error('Error occurred in startNewChatSession chatSessionService', [
                'exception' => $e->getMessage(),
            ]);
            return $this->apiResponse->errorResponse(
                message: "Failed create new chat session.",
                errors: [],
                codeResponse: 500,
            );
        }

        return $this->apiResponse->successResponse(
            message: "Success created new chat session",
            data: new ChatSessionResource($currentSessionData),
            codeResponse: 201,
        );
    }
}
