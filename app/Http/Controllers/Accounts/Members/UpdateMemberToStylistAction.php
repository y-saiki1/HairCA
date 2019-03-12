<?php

namespace App\Http\Controllers\Accounts\Members;

use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Members\UpdateMemberToStylistRequest;
use App\Domains\Repositories\Accounts\AccountQuery;
use App\Domains\UseCases\Accounts\Stylists\ICreateStylistUseCase;
use App\Http\Responders\Auth\TokenResponder;

class UpdateMemberToStylistAction
{
    /**
     * Update Member To Stylist
     * 
     * 会員をスタイリストに更新する (招待された人が会員だった場合に使用すること)
     * 
     * @group Member
     * 
     * @bodyParam email string required ログインするアカウントのメールアドレス Example: example@exam.com
     * @bodyParam password string required パスワード Example: password
     * @bodyParam invitation_token string required 招待メールに付いてくるトークン Example: token
     * @response 200 {
     *  "access_token": "token",
     *  "token_type": "bearer",
     *  "expires_in": 3600
     * }
     * @param UpdateMemberToStylistRequest
     * @param AccountQuery
     * @param CreateStylistUseCase
     * @param TokenResponder
     */
    public function __invoke(
        UpdateMemberToStylistRequest $request,
        ICreateStylistUseCase $createStylistUseCase,
        AccountQuery $accountQuery,
        TokenResponder $tokenResponder
    ) {
        $jwt = $accountQuery->login(
            $request->email,
            $request->password
        );
        $account = $accountQuery->myAccount();
        $createStylistUseCase(
            $account,
            $request->password,
            $request->invitation_token
        );

        return $tokenResponder($jwt);
    }
}