<?php

namespace App\Domains\UseCases\Accounts\Members;

use App\Domains\Models\JWT\JsonWebToken;
use App\Domains\UseCases\Accounts\AccountUseCaseQuery;
use App\Domains\UseCases\Accounts\Members\MemberUseCaseCommand;

class CreateMemberUseCase
{
    /**
     * @var MemberUseCaseCommand
     */
    private $memberCommand;

    /**
     * @var AccountUseCaseQuery
     */
    private $accountQuery;

    /**
     * @param MemberUseCaseCommand
     * @param AccountUseCaseQuery
     */
    public function __construct(AccountUseCaseQuery $accountQuery, MemberUseCaseCommand $memberCommand)
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