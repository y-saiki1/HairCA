<?php

namespace App\Http\Controllers\Accounts\Stylists;

use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Stylists\InviteStylistRequest;
use Packages\Domain\UseCases\Accounts\Stylists\InviteStylistUseCase;
use App\Http\Responders\Accounts\Stylists\InviteStylistResponder;

class InviteAction extends Controller
{
    /**
     * Invite Stylist
     * 
     * スタイリスト招待
     * 
     * 現在ログインしているスタイリストアカウントで招待メールを送る。
     * 
     * @group Stylist
     * 
     * @bodyParam email string required 招待するユーザーのメールアドレス Example: example@exam.com
     * @bodyParam recommendation string required 推薦文 Example: Laravelのドキュメント自動生成ツールまじで優秀
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
        InviteStylistResponder $responder
    ) {
        $token = $inviteStylistUseCase(
            $request->email, 
            $request->recommendation
        );

        return $responder($token);
    }
}
