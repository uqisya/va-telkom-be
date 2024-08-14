<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Resources\ChatSessionResource;
use App\Services\ChatSessionService;
use Illuminate\Http\Request;

class ChatSessionController
{

    private $apiResponse;
    private $chatSessionService;

    public function __construct(ApiResponseHelper $apiResponse, ChatSessionService $chatSessionService)
    {
        $this->apiResponse = $apiResponse;
        $this->chatSessionService = $chatSessionService;
    }

    public function getAllChatSessions()
    {
        $chatSessionsData = $this->chatSessionService->getAllChatSessions();

        return $this->apiResponse->successResponse(
            message: "Success get all chat sessions.",
            data: ChatSessionResource::collection($chatSessionsData),
            codeResponse: 200,
        );
    }

    public function startNewChatSession()
    {
        $currentSessionData = $this->chatSessionService->startNewChatSession();

        return $this->apiResponse->successResponse(
            message: "Success created new chat session",
            data: new ChatSessionResource($currentSessionData),
            codeResponse: 201,
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
