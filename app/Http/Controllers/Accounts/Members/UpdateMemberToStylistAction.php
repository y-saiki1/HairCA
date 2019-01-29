<?php

namespace App\Http\Controllers\Accounts\Members;

use App\Http\Controllers\Controller;

use App\Domains\UseCases\Accounts\Stylists\MemberUseCaseQuery;

class UpdateMemberToStylist
{
    /**
     * @var StylistUseCaseQuery
     */
    private $memberQuery;

    /**
     * @param StylistUseCaseQuery
     */
    public function __construct(MemberUseCaseQuery $memberQuery)
    {
        $this->memberQuery = $memberQuery;
    }

    /**
     * @param Request
     * @param UseCase
     * @param Responder
     */
    public function __invoke($request, $useCase, $responder)
    {
        $this->memberQuery->findByEmailAddressAndPassword($request->email, $request->password);
    }
}