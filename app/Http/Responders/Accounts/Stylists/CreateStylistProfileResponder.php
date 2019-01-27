<?php

namespace App\Http\Responders\Accounts\Stylists;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateStylistProfileResponder
{
    /**
     *  @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'StylistProfile created'
            ],
            Response::HTTP_CREATED
        );
    }
}