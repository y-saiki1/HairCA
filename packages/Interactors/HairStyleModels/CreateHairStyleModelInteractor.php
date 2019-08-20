<?php

namespace Packages\Interactors\StyleModels;

use Packages\Domain\Exceptions\NotStylistException;
use Packages\Domain\Repositories\HairStyleModels\HairStyleModelCommand;
use Packages\Domain\UseCases\HairStyleModels\CreateHairStyleModelUseCase;

class CreateHairStyleModelInteractor implements CreateHairStyleModelUseCase
{
    private $accountQuery;
    private $hairStyleModelCommand;

    public function __construct(
        AccountQuery $accountQuery, 
        HairStyleModelCommand $hairStyleModelCommand
    ) {
        $this->accountQuery = $accountQuery;
        $this->hairStyleModelCommand = $hairStyleModelCommand;
    }

    /**
     * @param int 年齢
     * @param int 性別
     * @param int 顔の形
     * @param int 髪の毛のタイプ
     * @param int 髪の毛の太さ
     * @param int 毛量
     * @throws NotStylistException
     * @return int スタイルモデルID
     */
    public function __invoke(
        int $age,
        int $sex,
        int $face_type_id,
        int $hair_type_id,
        int $hair_bold_type_id,
        int $hair_amount_type_id
    ): int {
        $stylist = $this->accountQuery->myAccount();
        if (! $stylist->isStylist()) throw new NotStylistException('Only Stylist Account can create Stylist Book', NotStylistException::ERROR_CODE);
        
        $this->hairStyleModelCommand->save(
            $stylist->id(),
            $age,
            $sex,
            $face_type_id,
            $hair_type_id,
            $hair_bold_type_id,
            $hair_amount_type_id
        );
   }
}