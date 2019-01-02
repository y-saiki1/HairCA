<?php

namespace App\Http\Controllers\Accounts;

use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class RetrieveAction extends Controller
{
    private $authManager;

    public function __construct(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }

    public function __invoke(Request $request)
    {
        return $this->authManager->guard('api')->user();
    }
}