<?php

namespace Tests\Unit\Domains\UseCases\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Domains\UseCases\Auth\InviteAccount;

use App\Domains\Repositories\Email\MailCommandRepository;
use App\Domains\Repositories\Account\AccountQueryRepository;

use App\Domains\Models\Account\Account;
use App\Domains\Models\Account\AccountId;
use App\Domains\Models\Account\AccountName;
use App\Domains\Models\Account\AccountHashedPassword;
use App\Domains\Models\Email\EmailAddress;

class InviteAccountTest extends TestCase
{
    private $mockMailCommand;
    private $mockAccountQuery;

    public function setUp()
    {   
        parent::setUp();

        $this->mockMailCommand = new class implements MailCommandRepository
        {
            public function send(): bool
            {
                return true;
            }
        };

        $this->mockAccountQuery = new class implements AccountQueryRepository
        {
            
            public function myAccount(): Account
            {
                return new Account(
                    new AccountId(1),
                    new AccountName('saiki'),
                    new EmailAddress('saiki@saiki'),
                    new AccountHashedPassword('password')
                );
            }

            public function findByEmail(EmailAddress $email): Account
            {

            }
        };
    }

    /**
     * @test
     */
    public function run_()
    {
        $inviteAccount = new InviteAccount(
            $this->mockMailCommand,
            $this->mockAccountQuery
        );

        $isSend = $inviteAccount(new EmailAddress('saiki@saiki'));
        $this->assertTrue($isSend);
    }
}
