<?php

namespace Test;

trait RequestsDataTrait 
{
    
    public $header = [
        'Authorization' => 'Bearer ',
        'Accept'        => 'application/json',
        'Content-Type'  => 'application/json',
    ];

    public function login()
    {
        $content = [
            "style_book" => [
                "name"        => "テストブック",
                "discription" => "特になし",
                "is_publish"  => 1
            ],
        
            "style_book_detail" => [
                "origin_hair_color_id"  => 1,
                "abount_hair_color_id"  => 2,
                "detail_hair_color_id"  => 3,
                "hair_length_type_id"   => 4,
            ],
        
            "style_model" => [
                "age"                  => 1,
                "sex"                  => 1,
                "face_type_id"         => 1,
                "hair_type_id"         => 2,
                "hair_bold_type_id"    => 3,
                "hair_amount_type_id"  => 4,
            ],
        ];

        $response = $this
            ->withHeaders($this->header)
            ->json('POST', '/v1/accounts/stylists/stylebooks', $content);
dd($response);
            // ->assertExactJson([

            // ]);
    }
}