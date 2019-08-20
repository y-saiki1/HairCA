<?php

namespace Packages\Domain\Repositories\StyleBooks;

interface StyleBookCommand
{ 
    public function saveStyleBook(
        int $styleModelId,
        string $name,
        string $discription,
        bool $is_publish,
        int $origin_hair_color_id,
        int $abount_hair_color_id,
        int $detail_hair_color_id,
        int $hair_length_type_id
    );
}