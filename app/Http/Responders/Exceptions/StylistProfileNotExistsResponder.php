<?php

namespace App\Http\Responders\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Http\Responders\Exceptions\ErrorResponse;

use App\Domains\Exceptions\StylistProfileNotExistsException;

class StylistProfileNotExistsResponder
{
    public function __invoke(StylistProfileNotExistsException $e, array $inputParams): JsonResponse
    {
        $errorResponse = new ErrorResponse(
            ErrorResponse::STYLIST_PROFILE_NOTEXISTS,
            $e->getMessage(),
            $inputParams
        );

        return $errorResponse->toJson();
    }

}