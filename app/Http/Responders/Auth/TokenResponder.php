<?php

namespace App\Http\Responders\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TokenResponder
{
    /**
     * @param mixed トークン | null
     * @param int トークン有効期限
     * @return JsonResponse
     */
    public function __invoke($jwt): JsonResponse
    {
        if (! $jwt) {
            return new JsonResponse(
                [
                    'message' => 'Unauthrized',
                ], 
                Response::HTTP_UNAUTHORIZED
            );
        }

        return new JsonResponse(
            [
                'access_token' => $jwt->token(),
                'token_type' => $jwt->type(),
                'expires_in' => $jwt->ttl(),
            ], 
            Response::HTTP_OK
        );
    }
}