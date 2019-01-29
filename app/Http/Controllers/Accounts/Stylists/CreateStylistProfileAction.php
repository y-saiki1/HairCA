<?php

namespace App\Http\Controllers\Accounts\Stylists;

use App\Http\Requests\Accounts\Stylists\CreateStylistProfileRequest;
use App\Domains\UseCases\Accounts\Stylists\CreateStylistProfileUseCase;
use App\Http\Responders\Accounts\Stylists\CreateStylistProfileResponder;

use App\Domains\Models\Profile\BirthDate;
use App\Domains\Models\Profile\Sex;

class CreateStylistProfileAction
{
    /**
     * Create StylistProfile
     * 
     * スタイリストプロフィール作成
     * 
     * @group Stylist
     * 
     * @bodyParam introduction string required 自己紹介orPR Example: 美容師。好きなヘアスタイルは五分刈り・七三分け・パンチパーマ
     * @bodyParam base_id string required 拠点ID Example: 1
     * @bodyParam birth_date string required 誕生日をyyyymmddの書式にすること Example: 19941111
     * @bodyParam sex string required 性別 Example: 1
     * 
     * @response 201 {
     *  "message": "Stylist Profile created"
     * }
     * @param CreateStylistProfileRequest
     * @param CreateStylistProfileUseCase
     * @param CreateStylistProfileResponder
     */
    public function __invoke(
        CreateStylistProfileRequest $request,
        CreateStylistProfileUseCase $createStylistProfileUseCase,
        CreateStylistProfileResponder $responder
    ) {
        $createStylistProfileUseCase(
            $request->introduction,
            $request->base_id,
            new BirthDate($request->birth_date),
            new Sex($request->sex)
        );

        $responder();
    }
}