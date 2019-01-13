<?php

namespace App\Http\Controllers\Accounts\Stylists;

use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Stylists\CreateStylistRequest;
use App\Domains\UseCases\Accounts\Stylists\CreateStylistUseCase;
use App\Http\Responders\Auth\TokenResponder;

class CreateAction extends Controller
{
    /**
     * @param CreateStylistRequest アカウント作成リクエスト
     * @param UseCase
     */
    public function __invoke(
        CreateStylistRequest $request,
        CreateStylistUseCase $createAccountUseCase,
        TokenResponder $responder
    ) {
        $jwt = $createAccountUseCase(
            $request->name,
            $request->email,
            $request->password,
            $request->invitation_token
        );

        return $responder($jwt);
    }
}