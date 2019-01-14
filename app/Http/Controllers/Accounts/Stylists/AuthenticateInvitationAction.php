<?php

namespace App\Http\Controllers\Accounts\Stylists;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Accounts\Stylists\AuthenticateInvitationRequest;
use App\Domains\UseCases\Accounts\Stylists\AuthenticateInvitationUseCase;
use App\Http\Responders\Accounts\Stylists\AuthenticateInvitationResponder;

use App\Domains\Models\Account\Stylist\Guest;
use App\Domains\Models\Hash;

class AuthenticateInvitationAction extends Controller
{
    /**
     * 招待メール認証
     * 招待トークンと招待したメールアドレスが一致しているか判定し、一致していればメッセージと現在の自分のアカウントのタイプを返す。
     *
     *  招待メールが既にスタイリストか一般会員で登録されていた場合は is_member か is_stylist が true になる。ゲスト（アカウント持ってない）だった場合は is_guest が true になる。
     * 
     * ３つの内どれか一つがtrueだった場合は他はfalseになる。
     * @bodyParam email string required 招待メールを送ったメアド Example: example@exam.com
     * @bodyParam invitation_token string required 招待メールに付いてくるトークン Example: token
     * @response 200 {
     *  'message': 'The Guest that have this Email and Token is Stylist'
     *  'is_guest': true
     *  'is_stylist': false
     *  'is_member': false
     * }
     * @param AuthenticateInvitationRequest 招待認証リクエスト
     * @param AuthenticateInvitationUseCase 招待認証ユースケース
     * @param AuthenticateInvitationResponder 招待認証レスポンス
     */
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
