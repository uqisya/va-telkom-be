<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Http\Request;

class FaqController
{

    private $apiResponse;
    private $faqService;

    public function __construct(ApiResponseHelper $apiResponse, FaqService $faqService)
    {
        $this->apiResponse = $apiResponse;
        $this->faqService = $faqService;
    }

    public function getAllFaq()
    {
        $listFaq = $this->faqService->getAllFaq();

        return $this->apiResponse->successResponse(
            message: "Success Get All Faq List",
            data: FaqResource::collection($listFaq),
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
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
