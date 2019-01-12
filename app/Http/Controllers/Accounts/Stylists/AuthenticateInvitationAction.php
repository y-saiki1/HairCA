<?php

namespace App\Http\Controllers\Accounts\Stylists;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stylists\AuthenticateInvitationRequest;
use App\Http\Responders\Stylists\AuthenticateInvitationResponder;

use App\Domains\UseCases\Accounts\Stylists\AuthenticateInvitationUseCase;

use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Hash;

class AuthenticateInvitationAction extends Controller
{
    public function __invoke(
        AuthenticateInvitationRequest $request,
        AuthenticateInvitationUseCase $authenticateInvitationUseCase,
        AuthenticateInvitationResponder $responder
    ) {        
        $account = $authenticateInvitationUseCase(
            $request->email,
            $request->invitation_token
        );

        return $responder($account);
    }
}
