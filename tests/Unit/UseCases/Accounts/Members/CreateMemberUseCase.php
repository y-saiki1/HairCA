<?php

namespace Tests\Unit\Domains\UseCases\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domains\UseCases\Accounts\Members\CreateMemberUseCase;

class InviteAccountTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {   
        parent::setUp();
    }
}
