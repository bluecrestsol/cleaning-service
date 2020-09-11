<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Company store form request
 */
class CompanyStoreRequest extends FormRequest
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
            'name' => 'required',
            'country_id' => 'required',
            'reg_number' => 'nullable',
            'website' => 'nullable',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'linkedin' => 'nullable',
            'phone' => 'nullable',
            'whatsapp' => 'nullable',
            'line' => 'nullable',
            'facebook_username' => 'nullable',
            'customer_service_phone' => 'nullable',
            'customer_service_email' => 'required|email|unique:companies',
            'address.line_1' => 'required',
            'address.line_2' => 'nullable',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.zip' => 'required',
            'address.country_id' => 'required',
            'billing_details.first_name' => 'nullable',
            'billing_details.last_name' => 'nullable',
            'billing_details.email' => 'required|email',
            'billing_details.mobile' => 'required',
            'billing_details.phone' => 'nullable',
            'billing_details.name' => 'required',
            'billing_details.tax_code' => 'nullable',
            'billing_details.address.line_1' => 'required',
            'billing_details.address.line_2' => 'nullable',
            'billing_details.address.city' => 'required',
            'billing_details.address.state' => 'required',
            'billing_details.address.zip' => 'required',
            'billing_details.address.country_id' => 'required',
        ];

        $method = $this->getMethod();
        if ($method == 'PUT') {
            $rules['customer_service_email'] .= ",customer_service_email,{$this->route('company')}";
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
            'country_id' => 'country',
            'facebook_username' => 'facebook handle',
            'address.line_1' => 'line 1',
            'address.line_2' => 'line 2',
            'address.city' => 'city',
            'address.state' => 'state',
            'address.zip' => 'zip',
            'address.country_id' => 'country',
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
            'name.required' => __('staff/validations.required'),
            'country_id.required' => __('staff/validations.required'),
            'customer_service_email.required' => __('staff/validations.required'),
            'customer_service_email.email' => __('staff/validations.email'),
            'address.line_1.required' => __('staff/validations.required'),
            'address.city.required' => __('staff/validations.required'),
            'address.state.required' => __('staff/validations.required'),
            'address.zip.required' => __('staff/validations.required'),
            'address.country_id.required' => __('staff/validations.required'),
            'billing_details.email.required' => __('staff/validations.required'),
            'billing_details.email.email' => __('staff/validations.email'),
            'billing_details.mobile.required' => __('staff/validations.required'),
            'billing_details.name.required' => __('staff/validations.required'),
            'billing_details.address.line_1.required' => __('staff/validations.required'),
            'billing_details.address.city.required' => __('staff/validations.required'),
            'billing_details.address.state.required' => __('staff/validations.required'),
            'billing_details.address.zip.required' => __('staff/validations.required'),
            'billing_details.address.country_id.required' => __('staff/validations.required')
        ];
    }
}