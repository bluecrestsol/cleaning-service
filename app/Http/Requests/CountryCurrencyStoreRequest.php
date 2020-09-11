<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryCurrencyStoreRequest extends FormRequest
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
            'currency_id' => 'required',
            'status' => '',
            'is_primary' => ''
        ];
    }

    public function attributes()
    {
        return [
            'currency_id' => 'currency'
        ];
    }

    public function messages()
    {
        return [
            'language.required' => __('staff/validations.required')
        ];
    }
}