<?php

namespace App\Http\Controllers\Accounts\Stylists;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stylists\AuthenticateInvitationTokenRequest;
use App\Http\Responders\Stylists\AuthenticateInvitationTokenResponder;

use App\Domains\UseCases\Accounts\Stylists\FindMyProfileUseCase;

use App\Domains\Models\BaseAccount\AccountName;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\BaseAccount\AccountType;
use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Email\EmailAddress;
use App\Domains\Models\Hash;

class AuthenticateInvitationTokenAction extends Controller
{
    public function __invoke(
        AuthenticateInvitationTokenRequest $request,
        FindMyProfileUseCase $findMyProfileUseCase,
        AuthenticateInvitationTokenResponder $responder
    ) {
        $emailAddress = new EmailAddress($request->input('email'));
        $invitationToken = new Hash($request->input('invitation_token'));
        
        $account = $findMyProfileUseCase(
            $emailAddress,
            $invitationToken
        );
dd($account);
        // $guest = new Guest(
        //     new AccountName($request->input('name')),
        //     new AccountType(Stylist::ACCOUNT_TYPE),
        //     new AccountPassword($request->input('password'))
        // );

        return $responder($account);
    }
}
