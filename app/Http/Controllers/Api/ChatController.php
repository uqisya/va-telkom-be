<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Requests\ChatRequest;
use App\Http\Resources\ChatResource;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController
{

    private $apiResponse;
    private $chatService;

    public function __construct(ApiResponseHelper $apiResponse, ChatService $chatService)
    {
        $this->apiResponse = $apiResponse;
        $this->chatService = $chatService;
    }

    public function getFirstChatByChatSessionID($chatSessionID)
    {
        $firstChatData = $this->chatService->getFirstChatByChatSessionID($chatSessionID);

        return $this->apiResponse->successResponse(
            message: "Success get first chat.",
            data: new ChatResource($firstChatData),
            codeResponse: 200,
        );
    }

    public function createNewMessage($chatSessionID, ChatRequest $request)
    {
        $chatData = $request->validated();

        $chatClientData = $this->chatService->createNewMessage($chatSessionID, $chatData['fullname'], $chatData['message']);

        $responseReply = $this->chatService->replyChat($chatClientData->message);

        $chatAssistantData = $this->chatService->createNewMessage($chatSessionID, "Telkom Indonesia", $responseReply);

        return $this->apiResponse->successResponse(
            message: "Success reply user question.",
            data: new ChatResource($chatAssistantData),
            codeResponse: 200,
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
