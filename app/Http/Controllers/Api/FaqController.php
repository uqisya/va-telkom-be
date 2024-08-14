<?php

namespace App\Http\Controllers\Api;


use App\Helpers\ApiResponseHelper;
use App\Http\Requests\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
    FaqController -> class untuk menghandle request API terkait Faq
    - getAllFaq -> method untuk mendapatkan semua list faq
*/

class FaqController
{

    private $apiResponse;
    private $faqService;

    public function __construct(ApiResponseHelper $apiResponse, FaqService $faqService)
    {
        $this->apiResponse = $apiResponse;
        $this->faqService = $faqService;
    }

    // method untuk mendapatkan semua list faq
    public function getAllFaq()
    {
        try {
            // return array object faq
            $listFaq = $this->faqService->getAllFaq();
        } catch (\Exception $e) {
            Log::error('Error occurred in getAllFaq faqService', [
                'exception' => $e->getMessage(),
            ]);
            // return response API dengan format error
            return $this->apiResponse->errorResponse(
                message: "Failed to retrieve FAQs.",
                errors: [],
                codeResponse: 500,
            );
        }

        // return response API dengan format data FaqResource
        return $this->apiResponse->successResponse(
            message: "Success Get All Faq List",
            data: FaqResource::collection($listFaq),
            codeResponse: 200,
        );
    }
}
