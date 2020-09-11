<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => '',
            'role' => 'required',
            'status' => 'required',
            'active_company_id' => 'required',
            'active_country_id' => 'required',
        ];

        $method = $this->getMethod();
        if ($method == 'PUT') {
            $rules['email'] .= ",email,{$this->route('staff')}";
        } else if ($method == 'POST') {
            $rules['password'] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'active_company_id' => 'active company',
            'active_country_id' => 'active country',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => __('staff/validations.required'),
            'last_name.required' => __('staff/validations.required'),
            'email.required' => __('staff/validations.required'),
            'password.required' => __('staff/validations.required'),
            'role.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
            'email.email' => __('staff/validations.email'),
            'email.unique' => __('staff/validations.unique'),
            'active_company_id.required' => __('staff/validations.required'),
            'active_country_id.required' => __('staff/validations.required'),
        ];
    }
}