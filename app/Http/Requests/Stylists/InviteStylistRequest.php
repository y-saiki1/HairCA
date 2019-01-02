<?php

namespace App\Http\Requests\Stylists;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Http\Responders\Stylists\InviteStylistResponder;

class InviteStylistRequest extends FormRequest
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
            'email' => 'required|email',
        ];
    }

    // /**
    //  * バリデーション失敗時、json返却
    //  * @param Validator
    //  */
    // protected function failedValidation(Validator $validator)
    // {
    //     $responder = \App::make(InviteStylistResponder::class);
    //     throw new HttpResponseException($responder(false));
    // }
}
