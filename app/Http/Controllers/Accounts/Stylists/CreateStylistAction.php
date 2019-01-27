<?php

namespace App\Http\Controllers\Accounts\Stylists;

use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Stylists\CreateStylistRequest;
use App\Domains\UseCases\Accounts\Stylists\CreateStylistUseCase;
use App\Http\Responders\Auth\TokenResponder;

class CreateStylistAction extends Controller
{
    /**
     * Create Stylist
     * 
     * スタイリスト作成
     * 
     * アカウントに使う基本情報とスタイリストとしてこのアプリケーションに登録する。
     * 
     * @group Stylist
     * 
     * @bodyParam name string required アカウント名 Example: アカウント名
     * @bodyParam email string required ログインするアカウントのメールアドレス Example: example@exam.com
     * @bodyParam password string required パスワード Example: password
     * @bodyParam password_confirmation string required 確認パスワード Example: password
     * @bodyParam invitation_token string required 招待トークン Example: token
     * @response 200 {
     *  "access_token": "token",
     *  "token_type": "bearer",
     *  "expires_in": 3600
     * }
     * @response 400 {
     *  "message": "UnAuthorized"
     * }
     * @param CreateStylistRequest アカウント作成リクエスト
     * @param CreateStylistUseCase アカウント作成ユースケース
     * @param TokenResponder トークンレスポンス
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