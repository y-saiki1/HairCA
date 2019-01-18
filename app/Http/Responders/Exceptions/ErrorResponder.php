<?php

namespace App\Http\Responders\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ErrorResponder
{
    /**
     * @param Exception ドメインルールエラー
     * @param array ユーザー入力パラメーター
     * @param int Httpステータスコード
     */
    public function __invoke(
        \Exception $e,
        array $inputParams,
        int $httpStatusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return new JsonResponse([
            'error_code' => $e->getCode(),
            'message'    => $e->getMessage(),
            'params'     => $inputParams,
        ], $httpStatusCode);
    }

}