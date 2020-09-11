<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyCountryStoreRequest extends FormRequest
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
            'country_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'country'
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => __('staff/validations.required'),
        ];
    }
}