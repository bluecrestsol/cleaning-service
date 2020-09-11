<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SuffixCountryCodeValidator;

/**
 * Agent store form request
 */
class PlaceStoreRequest extends FormRequest
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
        $place = $this->route('place') ?? 'NULL';
        return [
            'code' => [
                'sometimes',
                'required',
                'regex:/(^P)(\d{8})/',
                new SuffixCountryCodeValidator(),
                'unique:places,code,'.$place.',id,country_id,'.$this->country_id
            ],
            'financial_type' => 'required',
            'agent_id' => 'required',
            'customer_id' => 'required',
            'name' => 'required',
            'type' => 'required',
            'places_category_id' => 'required',
            'status' => 'required',
            'area' => 'nullable|numeric',
            'state_id' => 'required',
            'city_id' => 'required',
            'district_id' => 'required',
            'is_listing_public' => 'nullable',
            'is_history_public' => 'nullable',
            'is_gallery_public' => 'nullable',
            'country_id' => 'nullable',
            'address.line_1' => 'required',
            'address.line_2' => 'nullable',
            'address.city' => 'required',
            'address.state' => 'required',
            'address.zip' => 'required',
            'address.country_id' => 'required',
            'billing_details.first_name' => 'nullable',
            'billing_details.last_name' => 'nullable',
            'billing_details.email' => 'sometimes|required|email',
            'billing_details.mobile' => 'sometimes|required',
            'billing_details.phone' => 'nullable',
            'billing_details.name' => 'sometimes|required',
            'billing_details.tax_code' => 'nullable',
            'billing_details.address.line_1' => 'sometimes|required',
            'billing_details.address.line_2' => 'nullable',
            'billing_details.address.city' => 'sometimes|required',
            'billing_details.address.state' => 'sometimes|required',
            'billing_details.address.zip' => 'sometimes|required',
            'billing_details.address.country_id' => 'sometimes|required',
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
            'agent_id' => 'agent',
            'customer_id' => 'customer',
            'places_category_id' => 'category',
            'state_id' => 'state',
            'city_id' => 'city',
            'district_id' => 'district',
            'is_listing_public' => 'public listing',
            'is_history_public' => 'public history',
            'is_gallery_public' => 'public photos',
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
            'code.required' => __('staff/validations.required'),
            'code.regex' => __('staff/validations.regex'),
            'code.unique' => __('staff/validations.unique'),
            'financial_type.required' => __('staff/validations.required'),
            'agent_id.required' => __('staff/validations.required'),
            'customer_id.required' => __('staff/validations.required'),
            'name.required' => __('staff/validations.required'),
            'type.required' => __('staff/validations.required'),
            'category_id.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
            'area.numeric' => __('staff/validations.numeric'),
            'state_id.required' => __('staff/validations.required'),
            'city_id.required' => __('staff/validations.required'),
            'district_id.required' => __('staff/validations.required'),
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