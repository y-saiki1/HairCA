<?php

namespace Packages\Domain\UseCases\Accounts\StylistProfiles;

use Packages\Domain\Exceptions\NotStylistException;

use Packages\Domain\Models\Profile\BirthDate;
use Packages\Domain\Models\Profile\Sex;

interface CreateStylistProfileUseCase
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