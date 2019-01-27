<?php

namespace App\Http\Requests\Accounts\Stylists;

use Illuminate\Foundation\Http\FormRequest;

class CreateStylistProfileRequest extends FormRequest
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
            'age'                      => 'required|int',
            'sex'                      => 'required|int',
            'introduction'             => 'required|string|max:600',
            'base_id'                     => 'required|int|exists:bases,id',
        ];
    }
}
