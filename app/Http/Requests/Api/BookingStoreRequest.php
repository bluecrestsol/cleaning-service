<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'booked_at' => 'nullable',
            'name' => 'required',
            'business_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'required',
            'property_type' => 'required',
            'area' => 'required',
            'service_id' => 'nullable',
            'address' => 'required',
            'notes' => 'nullable',
            'country_id' => 'required',
            'category_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'area' => 'area size',
            'category_id' => 'category',
            'company_id' => 'company',
            'country_id' => 'country',
            'service_id' => 'service',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('customer/validations.custom.name.required'),
            'email.email' => __('staff/validations.email'),
            'phone.required' => __('customer/validations.custom.phone.required'),
            'area.required' => __('customer/validations.custom.area.required'),
            'address.required' => __('customer/validations.custom.address.required'),
            'property_type.required' => __('customer/validations.custom.property_type.required'),
            'category_id.required' => __('customer/validations.custom.category.required'),
            'country_id.required' => __('staff/validations.required')
        ];
    }
}
