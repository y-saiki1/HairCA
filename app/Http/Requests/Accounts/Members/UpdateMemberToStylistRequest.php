<?php

namespace App\Http\Requests\Accounts\Members;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberToStylistRequest extends FormRequest
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
            'email'            => 'required|max:255|email|exists:guests,email',
            'password'         => 'required|min:8|max:16',
            'invitation_token' => 'required|max:255|exists:guests,token',
        ];
    }
}
