<?php

namespace App\Http\Requests;

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
            'status' => 'required',
            'booked_at' => 'sometimes|required',
            'name' => 'required',
            'business_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'required',
            'property_type' => 'sometimes|required',
            'area' => 'required',
            'service_id' => 'nullable',
            'address' => 'required',
            'notes' => 'nullable',
            'company_id' => 'nullable',
            'country_id' => 'required',
            'category_id' => 'sometimes|required',
        ];
    }

    public function attributes()
    {
        return [
            'area' => 'area size',
            'category_id' => 'category',
            'company_id' => 'company',
            'country_id' => 'country',
        ];
    }

    public function messages()
    {


        if(isAdminRoute()) {
            return [
                'status.required' => __('staff/validations.required'),
                'booked_at.required' => __('staff/validations.required'),
                'name.required' => __('staff/validations.required'),
                'business_name.required' => __('staff/validations.required'),
                'email.required' => __('staff/validations.required'),
                'email.email' => __('staff/validations.email'),
                'phone.required' => __('staff/validations.required'),
                'area.required' => __('staff/validations.required'),
                'property_type.required' => __('staff/validations.required'),
                'category_id.required' => __('staff/validations.required'),
                'country_id.required' => __('staff/validations.required'),
                'company_id.required' => __('staff/validations.required'),
            ];
        } else {
            return [
                'status.required' => __('customer/validations.required'),
                'booked_at.required' => __('staff/validations.required'),
                'name.required' => __('customer/validations.custom.booking_name.required'),
                'business_name.required' => __('staff/validations.required'),
                'email.required' => __('staff/validations.required'),
                'email.email' => __('staff/validations.email'),
                'phone.required' => __('customer/validations.custom.booking_phone.required'),
                'area.required' => __('customer/validations.custom.booking_area.required'),
                'address.required' => __('customer/validations.custom.booking_address.required'),
                'property_type.required' => __('customer/validations.custom.booking_property_type.required'),
                'category_id.required' => __('customer/validations.custom.booking_category.required'),
                'country_id.required' => __('staff/validations.required'),
                'company_id.required' => __('staff/validations.required'),
            ];
        }
    }
}
