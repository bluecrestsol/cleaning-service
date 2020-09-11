<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Service store form request
 */
class ServiceStoreRequest extends FormRequest
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
            'description.*' => 'required',
            'public_name.*' => 'required',
            'type' => 'required',
            'price' => 'nullable',
            'discounted_price' => 'nullable',
            'status' => 'required',
            'company_id' => 'nullable',
            'country_id' => 'nullable',
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
            'description.*' => 'description',
            'public_name.*' => 'public name',
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
            'description.*.required' => __('staff/validations.required'),
            'public_name.*.required' => __('staff/validations.required'),
            'type.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
        ];
    }
}