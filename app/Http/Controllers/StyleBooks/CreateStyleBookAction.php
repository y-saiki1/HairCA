<?php

namespace App\Http\Controllers\StyleBooks;

use App\Http\Controllers\Controller;
use App\Http\Requests\StyleBooks\CreateStyleBookRequest;
use Packages\Domain\UseCases\StyleBooks\CreateStyleBookUseCase;
use Packages\Domain\UseCases\HairStyleModels\CreateHairStyleModelUseCase;

class CreateStyleBookAction extends Controller
{
    /**
     * @param CreateStyleBookRequest
     */
    public function __invoke(
        CreateStyleBookRequest $request,
        CreateStyleBookUseCase $createStyleBookUseCase,
        CreateHairStyleModelUseCase $createStyleModelUseCase
        // Responder $responder
    ) {
        $styleModelId = $request->style_model_id;
        
        // // StyleModel作成UseCase
        if (! empty($request->style_model)) {
            $styleModel = $createStyleModelUseCase($request->style_model);
            $styleModelId = $styleModel->id;
        }

        // StyleBookとStyleBookDetailのどちらも作成する
        $createStyleBookUseCase(
            $styleModelId,
            
            $request->style_book['name'],
            $request->style_book['discription'],
            $request->style_book['is_publish'],

            $request->style_book_detail['origin_hair_color_id'],
            $request->style_book_detail['abount_hair_color_id'],
            $request->style_book_detail['detail_hair_color_id'],
            $request->style_book_detail['hair_length_type_id']
        );
    }
}