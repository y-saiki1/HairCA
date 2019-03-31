<?php

namespace Packages\Domain\Models\Profile;

class HomeAddress
{
    /**
     * @var 都道府県
     */
    private $prefecture;
    
    /**
     * @var 市区町村
     */
    private $municipality;
    
    /**
     * @var 番地
     */
    private $streetNumber;
    
    /**
     * @var 建物名
     */
    private $buildingName;

    /**
     * @param string 都道府県
     * @param string 市区町村
     * @param string 番地
     * @param string 建物名
     */
    public function __construct(
        string $prefecture,
        string $municipality,
        string $streetNumber,
        ?string $buildingName
    ) {
        $this->prefecture = $prefecture;
        $this->municipality = $municipality;
        $this->streetNumber = $streetNumber;
        $this->buildingName = $buildingName ?? '';
    }
}