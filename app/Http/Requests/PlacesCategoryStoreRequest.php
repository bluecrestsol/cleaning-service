<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacesCategoryStoreRequest extends FormRequest
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
            'type' => 'required',
            'name.*' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name.*' => 'name',
        ];
    }

    public function messages()
    {
        return [
            'type.required' => __('staff/validations.required'),
            'name.*.required' => __('staff/validations.required')
        ];
    }
}