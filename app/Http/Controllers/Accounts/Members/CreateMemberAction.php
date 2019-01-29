<?php

namespace App\Http\Controllers\Accounts\Members;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\Members\CreateMemberRequest;
use App\Domains\UseCases\Accounts\Members\CreateMemberUseCase;
use App\Http\Responders\Auth\TokenResponder;

class CreateMemberAction
{
    /**
     * Create Member
     * 
     * 一般ユーザー作成
     * 
     * @group Member
     * 
     * @bodyParam name string required アカウント名 Example: アカウント名
     * @bodyParam email string required ログインするアカウントのメールアドレス Example: example@exam.com
     * @bodyParam password string required パスワード Example: password
     * @bodyParam password_confirmation string required 確認パスワード Example: password
     * @response 200 {
     *  "access_token": "token",
     *  "token_type": "bearer",
     *  "expires_in": 3600
     * }
     * @param CreateMemberRequest
     * @param CreateMemberUseCase
     * @param TokenResponder
     */
    public function __invoke(CreateMemberRequest $request, CreateMemberUseCase $createMemberUseCase, TokenResponder $responder)
    {
        $jwt = $createMemberUseCase(
            $request->name,
            $request->email,
            $request->password
        );

        return $responder($jwt);
    }
}