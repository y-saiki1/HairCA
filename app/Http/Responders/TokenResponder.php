<?php

namespace App\Http\Responders;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TokenResponder
{
    /**
     * @param string トークン
     * @param int トークン有効期限
     * @return JsonResponse
     */
    public function __invoke($token, int $ttl): JsonResponse
    {
        if (! $token) {
            return new JsonResponse(
                [
                    'message' => 'Unauthrized',
                ], 
                Response::HTTP_UNAUTHORIZED
            );
        }

        return new JsonResponse(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => $ttl,
            ], 
            Response::HTTP_OK
        );
    }
}