<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FAQs category store form request
 */
class FaqCategoryStoreRequest extends FormRequest
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
     * list of validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name.*' => 'required',
            'status' => 'required',
            'country_id' => '',
        ];
    }

    /**
     * list of attributes to be changed on display
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name.*' => 'name',
        ];
    }

    /**
     * list of validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.*.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
        ];
    }
}