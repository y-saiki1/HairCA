<?php

namespace Packages\Infrastructures\Repositories\Eloquents\StyleBooks;

use Packages\Domain\Repositories\StyleBooks\StyleBookCommand;
use Packages\Infrastructures\Entities\Eloquents\EloquentStyleBook;
use Packages\Infrastructures\Entities\Eloquents\EloquentHairStyleModel;
use Packages\Infrastructures\Entities\Eloquents\EloquentStyleBookDetail;

class EloquentStyleBookCommand implements StyleBookCommand
{
    private $styleBook;
    private $styleBookDetail;

    public function __construct(
        EloquentStyleBook $styleBook, 
        EloquentStyleBookDetail $styleBookDetail,
        EloquentHairStyleModel $hairStyleModel
    ) {
        $this->styleBook = $styleBook;
        $this->styleBookDetail = $styleBookDetail;
    }

    public function saveStyleBook(
        $styleModelId,

        $stylistId,

        $name,
        $discription,
        $is_publish,

        $origin_hair_color_id,
        $abount_hair_color_id,
        $detail_hair_color_id,
        $hair_length_type_id
    ) {
        $styleBook = $this->styleBook->updateOrCreate(
            $stylistId,
            $name,
            $discription
        );
        $this->styleBookDetail->updateOrCreate(

        );
    }
}