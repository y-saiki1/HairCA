<?php

namespace App\Controllers\Accounts\Stylists;

use App\Http\Requests\Accounts\Stylists\CreateStylistProfileRequest;
use App\Domains\UseCases\Accounts\Stylists\CreateStylistProfileUseCase;
use App\Http\Responders\Accounts\Stylists\CreateStylistProfileResponder;

use App\Domains\Models\Account\Stylist\HairSalon;

class CreateStylistProfileAction
{
    /**
     * @param CreateStylistProfileRequest
     * @param CreateStylistProfileUseCase
     * @param CreateStylistProfileResponder
     */
    public function __invoke(
        CreateStylistProfileRequest $request,
        CreateStylistProfileUseCase $createStylistProfileUseCase,
        CreateStylistProfileResponder $responder
    ) {
        // $hairSalon = new HairSalon(
        //     $request->hair_salon_name,
        //     $request->hair_salon_postal_code,
        //     $request->hair_salon_prefecture,
        //     $request->hair_salon_municipality,
        //     $request->hair_salon_street_number,
        //     $request->hair_salon_building_name
        // );

        $createStylistProfileUseCase(
            $request->introduction,
            $request->age,
            $request->sex
        );
        
        $responder;
        
    }
}