<?php

namespace App\Http\Controllers\Accounts\Stylists;

use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Stylists\InviteStylistRequest;
use App\Domains\UseCases\Accounts\Stylists\InviteStylistUseCase;
use App\Http\Responders\Accounts\Stylists\InviteStylistResponder;

class InviteAction extends Controller
{
    /**
     * @bodyParam email string required 招待されるユーザーのメールアドレス Example: example@exam.com
     * @response 204 {}
     * @response 400 {
     *  "message":"The given data was invalid.",
     *  "errors":{
     *      "email":["The email must be a valid email address."]
     *  }
     * }
     * @response 500 {
     *  "message": "failed to send invite mail"
     * }
     * @param InviteStylistRequest
     * @param InviteStylistUseCase アカウント招待ユースケース
     * @param InviteStylistResponder
     */
    public function __invoke(
        InviteStylistRequest $request,
        InviteStylistUseCase $inviteStylistUseCase,
        InviteStylistResponder $inviteStylistResponder
    ) {
        $token = $inviteStylistUseCase(
            $request->email, 
            $request->recommendation
        );

        return $inviteStylistResponder($token);
    }
}
