<?php

namespace App\Http\Requests\StyleBooks;

use Illuminate\Foundation\Http\FormRequest;

class CreateStyleBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // StyleBook
            "style_book.name"        => "required|min:1|max:255",
            "style_book.discription" => "required|min:1|max:800",
            "style_book.is_publish"  => "required|boolean",

            // StyleBookDetail
            "style_book_detail.origin_hair_color_id" => "required",
            "style_book_detail.abount_hair_color_id" => "required",
            "style_book_detail.detail_hair_color_id" => "required",
            "style_book_detail.hair_length_type_id"  => "required",

            // StyleModel 既存のものを使う・新しい物を作る
            "style_model.age" => "required_without:style_model_id",
            "style_model.sex" => "required_without:style_model_id",
            "style_model.face_type_id" => "required_without:style_model_id",
            "style_model.hair_type_id" => "required_without:style_model_id",
            "style_model.hair_bold_type_id"   => "required_without:style_model_id",
            "style_model.hair_amount_type_id" => "required_without:style_model_id",

            // StyleModel既存選択の場合
            "style_model_id" => "required_without_all:age,sex,face_type_id,hair_type_id,hair_bold_type_id,hair_amount_type_id",
        ];
    }
}
