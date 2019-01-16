<?php

namespace App\Http\Responders\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Http\Responders\Exceptions\ErrorResponse;

use App\Domains\Exceptions\NotExistsException;

class NotExistsResponder
{
    public function __invoke(NotExistsException $e, $inputParams): JsonResponse
    {
        $errorResponse = new ErrorResponse(
            ErrorResponse::NOT_EXISTS,
            $e->getMessage(),
            $inputParams
        );

        return $errorResponse->toJson();
    }
}