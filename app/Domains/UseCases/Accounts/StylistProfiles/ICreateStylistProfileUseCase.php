<?php

namespace App\Domains\UseCases\Accounts\StylistProfiles;

use App\Domains\Exceptions\NotStylistException;

use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Profile\Sex;

interface ICreateStylistProfileUseCase
{
    /**
     * @param string 自己紹介文
     * @param int 活動拠点ID
     * @param BirthDate 生年月日
     * @param Sex 性別
     * @return bool
     * @throws NotStylistException
     */
    public function __invoke(string $introduction, int $baseId, BirthDate $birthDate, Sex $sex): bool;
}