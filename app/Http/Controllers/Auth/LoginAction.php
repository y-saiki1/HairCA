<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTGuard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responders\TokenResponder;

use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Domains\Models\BaseAccount\AccountPassword;
use App\Domains\Models\Email\EmailAddress;

class LoginAction extends Controller
{
    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @param AuthManager
     */
    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    /**
     * @bodyParam email string required ログインするアカウントのメールアドレス Example: example@exam.com
     * @bodyParam password string required ログインするアカウントのパスワード Example: password
     * @response 200 {
     *  "access_token": "aaaaaaaa",
     *  "token_type": "bearer",
     *  "expires_in": 3600
     * }
     * @response 400 {
     *  "message": ""
     * }
     * @param LoginRequest
     * @param TokenResponder
     * @return JsonResponse
     */
    public function __invoke(
        LoginRequest $request, 
        TokenResponder $responder,
        AccountUseCaseQuery $accountUseCaseQuery
    ): JsonResponse
    {
        $token = $accountUseCaseQuery->login(
            new EmailAddress($request->email),
            new AccountPassword($request->password)
        );
        
        return $responder(
            $token,
            60 * 60
            // $guard->factory()->getTTL() * 60
        );
    }
}