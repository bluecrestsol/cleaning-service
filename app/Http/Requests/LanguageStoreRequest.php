<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreRequest extends FormRequest
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
            'code' => 'required',
            'english_name' => 'required',
            'name' => 'required',
            'status_public' => '',
            'status_staff' => ''
        ];
    }

    public function messages()
    {
        return [
            'code.required' => __('staff/validations.required'),
            'english_name.required' => __('staff/validations.required'),
            'name.required' => __('staff/validations.required')
        ];
    }
}