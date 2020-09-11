<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'name' => 'required',
            'business_name' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'country_id' => 'required',
            'company_id' => 'nullable'
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
            'country_id' => 'country',
            'company_id' => 'company'
        ];
    }

    public function messages()
    {
        $messages = [];
        if (isAdminRoute()) {
            $messages = [
                'status.required' => __('staff/validations.required'),
                'name.required' => __('staff/validations.required'),
                'email.required' => __('staff/validations.required'),
                'email.email' => __('staff/validations.email'),
                'phone.required' => __('staff/validations.required'),
                'message.required' => __('staff/validations.required'),
                'country_id.required' => __('staff/validations.required'),
                'company_id.required' => __('staff/validations.required'),
            ];
        } else {
            $messages = [
                'status.required' => __('customer/validations.required'),
                'name.required' => __('customer/validations.custom.contact_name.required'),
                'email.required' => __('customer/validations.custom.contact_email.required'),
                'email.email' => __('customer/validations.email'),
                'phone.required' => __('customer/validations.custom.contact_phone.required'),
                'message.required' => __('customer/validations.custom.contact_message.required'),
                'country_id.required' => __('customer/validations.required'),
                'company_id.required' => __('customer/validations.required'),
            ];
        }
        return $messages;
    }
}
