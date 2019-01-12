<?php

namespace App\Http\Responders\Stylists;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Domains\Models\BaseAccount\Account;

class AuthenticateInvitationResponder
{
    /**
     * @param Account Accountインターフェイス継承クラス
     * @return JsonResponse
     */
    public function __invoke(Account $account): JsonResponse
    {
        return new JsonResponse(
            [
                'message'    => 'The Guest to have this Email and Token is ' . $account->accountTypeName(),
                'is_guest'   => $account->isGuest(),
                'is_stylist' => $account->isStylist(),
                'is_member'  => $account->isMember(),
            ], 
            Response::HTTP_OK
        );
    }
}