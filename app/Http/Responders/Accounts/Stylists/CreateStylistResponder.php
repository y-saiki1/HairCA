<?php

namespace App\Http\Responders\Accounts\Stylists;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateStylistResponder
{
    /**
     * @param bool スタイリスト保存成功
     */
    public function __invoke(bool $isSaved): JsonResponse
    {
        if (! $isSaved) {
            return new JsonResponse(
                [
                    'message' => 'Failed to create Stylist Account',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(
            [
                'message' => 'created Stylist Account',
            ],
            Response::HTTP_OK
        );
    }
}