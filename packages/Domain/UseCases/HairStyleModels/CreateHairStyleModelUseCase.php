<?php

namespace Packages\Domain\UseCases\HairStyleModels;

interface CreateHairStyleModelUseCase
{
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
    ): int;
}