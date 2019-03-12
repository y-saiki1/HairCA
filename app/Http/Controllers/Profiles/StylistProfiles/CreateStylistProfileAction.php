<?php

namespace App\Http\Controllers\Profiles\StylistProfiles;

use Illuminate\Http\Request;
use App\Domains\Models\Profile\Sex;
use App\Http\Controllers\Controller;
use App\Domains\Models\Profile\BirthDate;
use App\Http\Requests\Accounts\StylistProfiles\CreateStylistProfileRequest;
use App\Domains\UseCases\Accounts\StylistProfiles\ICreateStylistProfileUseCase;
use App\Http\Responders\Profiles\StylistProfiles\CreateStylistProfileResponder;

class CreateStylistProfileAction extends Controller
{
    /**
     * @param CreateStylistProfileRequest
     * @param ICreateStylistProfileUseCase
     * @param Responder
     */
    public function __invoke(
        CreateStylistProfileRequest $request,
        ICreateStylistProfileUseCase $createStylistProfileUseCase,
        CreateStylistProfileResponder $responder
    ) {
        $birthDate = new BirthDate($request->birth_date);
        $sex = new Sex($request->sex);

        $isSaved = $createStylistProfileUseCase(
            $request->introduction, 
            $request->base_id,
            $birthDate,
            $sex
        );

        return $responder();
    }
}