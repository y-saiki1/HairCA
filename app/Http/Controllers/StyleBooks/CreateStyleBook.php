<?php

namespace App\Http\Controllers\StyleBooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\StyleBooks\CreateStyleBookRequest;

class CreateStyleBookAction extends Controller
{
    /**
     * @param CreateStyleBookRequest
     */
    public function __invoke(
        CreateStyleBookRequest $request
        // CreateStyleBookUseCase $createStyleBookUseCase,
        // CreateStyleModelUseCase $createStyleModelUseCase,
        // Responder $responder
    ) {
dd($request->all());
        // StyleBookとStyleBookDetailのどちらも作成する
        // $createStyleBookUseCase(
        //     $request->style_book,
        //     $request->style_book_detail
        // );

        // // StyleModel作成UseCase
        // if (! $request->style_model_id) {
        //     $createStyleModelUseCase($request->style_model);
        // }


    }
}