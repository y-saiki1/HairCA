<?php

namespace App\Http\Responders\Accounts\Stylists;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InviteStylistResponder
{
    /**
     * アプリケーション例外のみ扱う。
     * @param string 招待トークン
     * @return JsonResponse
     */
    public function __invoke($invitationToken): JsonResponse
    {
        if (! $invitationToken) {
            return new JsonResponse(
                [
                    'message' => 'Failed to send invite mail',
                ], 
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(
            [
                'invitaion_token' => $invitationToken,
            ], 
            Response::HTTP_OK
        );
    }
}