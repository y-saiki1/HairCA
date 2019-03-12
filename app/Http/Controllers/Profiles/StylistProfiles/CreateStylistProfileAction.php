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
     * Create Stylist Profile
     * 
     * スタイリストプロフィール作成
     * 
     * @group Stylist
     * 
     * @bodyParam introduction string required 自己紹介文 Example: 俺は天才スタリスト
     * @bodyParam birth_date string required 生年月日 Example: 19941111
     * @bodyParam sex int required 性別：男 = 1, 女 = 2 Example: 1
     * @bodyParam base_id int required 拠点ID Example: 1
     * @response 200 {
     *  message': 'StylistProfile created'
     * }
     * @param CreateStylistProfileRequest
     * @param ICreateStylistProfileUseCase
     * @param CreateStylistProfileResponder
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