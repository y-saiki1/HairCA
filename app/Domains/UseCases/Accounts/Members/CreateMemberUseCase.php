<?php

namespace App\Domains\UseCases\Accounts\Members;

use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\Repositories\Accounts\AccountQuery;
use App\Domains\Repositories\Accounts\Members\MemberCommand;

class CreateMemberUseCase
{
    /**
     * @var MemberCommand
     */
    private $memberCommand;

    /**
     * @var AccountQuery
     */
    private $accountQuery;

    /**
     * @param MemberCommand
     * @param AccountQuery
     */
    public function __construct(AccountQuery $accountQuery, MemberCommand $memberCommand)
    {
        $this->accountQuery = $accountQuery;
        $this->memberCommand = $memberCommand;
    }

    /**
     * @param string アカウント名
     * @param string メールアドレス
     * @param JsonWebToken
     */
    public function __invoke(string $name, string $emailAddress, string $password): JsonWebToken
    {
        $this->memberCommand->saveMember($name, $emailAddress, $password);
        return $this->accountQuery->login($emailAddress, $password);
    }
}