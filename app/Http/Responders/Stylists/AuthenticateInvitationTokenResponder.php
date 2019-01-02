<?php

namespace App\Http\Responders\Stylists;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Domains\Models\BaseAccount\Account;

class AuthenticateInvitationTokenResponder
{
    /**
     * @param Stylist Accountインターフェイス継承クラス | NULL
     * @return JsonResponse
     */
    public function __invoke(Account $stylist): JsonResponse
    {
        if (! $stylist) {
            return new JsonResponse(
                [
                    'message' => 'failed to create stylist account',
                ], 
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse(
            $stylist->toArray(),
            Response::HTTP_CREATED
        );
    }
}