<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryLanguageStoreRequest extends FormRequest
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
    
    public function rules()
    {
        return [
            'language_id' => 'required',
            'status' => '',
            'is_primary' => ''
        ];
    }

    public function attributes()
    {
        return [
            'language_id' => 'language'
        ];
    }

    public function messages()
    {
        return [
            'language.required' => __('staff/validations.required')
        ];
    }
}