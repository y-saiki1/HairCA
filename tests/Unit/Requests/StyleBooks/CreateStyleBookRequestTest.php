<?php

namespace Test\Unit\Requests\StyleBooks;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

use Test\RequestsDataTrait;

class CreateStyleBookRequestTest extends TestCase
{
    use RefreshDatabase, RequestsDataTrait;

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testRun()
    {
        $this->login();
        $this->assertTrue(true);
    }
}