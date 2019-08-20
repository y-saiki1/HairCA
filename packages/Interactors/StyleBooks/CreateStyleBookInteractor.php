<?php

namespace Packages\Interactors\StyleBooks;

use Packages\Domain\Exceptions\NotStylistException;
use Packages\Domain\Repositories\Accounts\AccountQuery;
use Packages\Domain\Repositories\StyleBooks\StyleBookCommand;
use Packages\Domain\UseCases\StyleBooks\CreateStyleBookUseCase;

class CreateStyleBookInteractor implements CreateStyleBookUseCase
{
    private $accountQuery;
    private $styleBookCommand;

    public function __construct(AccountQuery $accountQuery, StyleBookCommand $styleBookCommand)
    {
        $this->accountQuery = $accountQuery;
        $this->styleBookCommand = $styleBookCommand;
    }

    /**
     * @param int
     * @param array
     * @param array
     */
    public function __invoke(
        int $styleModelId, 
        
        string $name,
        string $discription,
        bool $is_publish,

        int $origin_hair_color_id,
        int $abount_hair_color_id,
        int $detail_hair_color_id,
        int $hair_length_type_id
    ) {
        $stylist = $this->accountQuery->myAccount();
        if (! $stylist->isStylist()) throw new NotStylistException('Only Stylist Account can create Stylist Book', NotStylistException::ERROR_CODE);

        return $this->styleBookCommand->save(
            $styleModelId,
            
            $stylist->id(),

            $name,
            $discription,
            $is_publish,
            
            $origin_hair_color_id,
            $abount_hair_color_id,
            $detail_hair_color_id,
            $hair_length_type_id
        );
    }
}