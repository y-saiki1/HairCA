<?php

namespace App\Http\Responders;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * ErrorResponseを独自で実装しておけば、try catcheでエラーを複数キャッチするときに便利
 */
class ErrorResponse
{
    /**
     * @var int 存在しない
     */
    const NOT_EXISTS = 101;

    /**
     * @var int スタイリストのプロフィールが存在しない
     */
    const STYLIST_PROFILE_NOTEXISTS = 102;

    /**
     * @param int エラーコード
     */
    private $error_code;

    /**
     * @param string エラーメッセージ
     */
    private $message;

    /**
     * @param array ユーザー入力パラメーター
     */
    private $inputParam;

    /**
     * @param int エラーコード
     * @param string エラーメッセージ 
     * @param array ユーザー入力パラメーター
     */
    public function __construct(int $error_code, string $message, array $inputParam)
    {
        $this->error_code = $error_code;
        $this->message = $message;
        $this->params = $inputParams;
    }

    /**
     * @return JsonResponse
     */
    public function toJson(): JsonResponse
    {
        return new JsonResponse(
            [
                'error_code' => $this->error_code,
                'message'    => $this->message,
                'params'     => $this->inputParams
            ]
        );
    }
}