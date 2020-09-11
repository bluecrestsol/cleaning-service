<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Customer store form request
 */
class CustomerStoreRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'company_id' => 'nullable',
            'country_id' => 'nullable',
            'business_name' => 'nullable',
            'email' => 'nullable|email|unique:customers',
            'mobile' => 'required',
            'phone' => 'nullable',
            'line' => 'nullable',
            'whatsapp' => 'nullable',
            'language_id' => 'required',
            'billing_details.first_name' => 'nullable',
            'billing_details.last_name' => 'nullable',
            'billing_details.email' => 'nullable|email',
            'billing_details.mobile' => 'nullable',
            'billing_details.phone' => 'nullable',
            'billing_details.name' => 'nullable',
            'billing_details.tax_code' => 'nullable',
            'billing_details.address.line_1' => 'nullable',
            'billing_details.address.line_2' => 'nullable',
            'billing_details.address.city' => 'nullable',
            'billing_details.address.state' => 'nullable',
            'billing_details.address.zip' => 'nullable',
            'billing_details.address.country_id' => 'nullable',
        ];

        $method = $this->getMethod();
        if ($method == 'PUT') {
            $rules['email'] .= ",email,{$this->route('customer')}";
        }

        return $rules;
    }

    /**
     * list of attributes to be changed on display
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'language_id' => 'language',
            'billing_details.first_name' => 'first name',
            'billing_details.last_name' => 'last name',
            'billing_details.email' => 'email',
            'billing_details.mobile' => 'mobile',
            'billing_details.phone' => 'phone',
            'billing_details.name' => 'invoice name',
            'billing_details.tax_code' => 'tax code',
            'billing_details.address.line_1' => 'line 1',
            'billing_details.address.line_2' => 'line 2',
            'billing_details.address.city' => 'city',
            'billing_details.address.state' => 'state',
            'billing_details.address.zip' => 'zip',
            'billing_details.address.country_id' => 'country',
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
            'title.required' => __('staff/validations.required'),
            'first_name.required' => __('staff/validations.required'),
            'email.email' => __('staff/validations.email'),
            'email.unique' => __('staff/validations.unique'),
            'mobile.required' => __('staff/validations.required'),
            'language_id.required' => __('staff/validations.required'),
            'billing_details.email.email' => __('staff/validations.email'),
        ];
    }
}