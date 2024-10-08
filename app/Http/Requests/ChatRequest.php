<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ChatRequest extends FormRequest
{

    private $apiResponse;
    public function __construct(ApiResponseHelper $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string',
            'message' => 'required|string'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response =  $this->apiResponse->errorResponse(
            message: "Required message or fullname.",
            errors: $validator->errors()->toArray(),
            codeResponse: 400,
        );

        throw new ValidationException($validator, $response);
    }
}
