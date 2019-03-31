<?php

namespace App\Http\Controllers\Bases;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use Packages\Infrastructures\Entities\Eloquents\EloquentBase;

class IndexAction extends Controller
{
    /**
     * 
     * BaseList
     * 
     * 活動拠点一覧
     * 
     * 活動拠点を一覧形式で取得する
     * 
     * @group Base
     * 
     * @response 200 {
     *  "id": "1",
     *  "name": "北海道",
     *  "created_at": "Y-m-d H:i:s",
     *  "updated_at": "Y-m-d H:i:s"
     * }
     * @param Request リクエスト
     * @param EloquentBase
     */
    public function __invoke(Request $request, EloquentBase $eloquentBase)
    {
        return $eloquentBase->all();
    }
}