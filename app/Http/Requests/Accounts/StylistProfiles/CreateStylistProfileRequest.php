<?php

namespace App\Http\Requests\Accounts\StylistProfiles;

use App\Rules\Accounts\Profiles\ExistsSex;
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
            'introduction' => ['required', 'max:600'],
            'birth_date'   => ['required', 'date_format:Ymd'],
            'sex'          => ['required', new ExistsSex],
            'base_id'      => ['required', 'exists:bases,id']
        ];
    }
}
