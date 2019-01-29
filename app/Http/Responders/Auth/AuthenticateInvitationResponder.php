<?php

namespace App\Http\Responders\Accounts\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

use App\Domains\Models\Account\Account;

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
                'message'      => 'The Guest that have this Email and Token is ' . $account->accountTypeName(),
                'is_guest'     => $account->isGuest(),
                'is_stylist'   => $account->isStylist(),
                'is_member'    => $account->isMember(),
                'emailAddress' => $account->emailAddress(),
            ], 
            Response::HTTP_OK
        );
    }
}