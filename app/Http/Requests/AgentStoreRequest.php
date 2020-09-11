<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Agent store form request
 */
class AgentStoreRequest extends FormRequest
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
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'doc_type' => 'nullable',
            'doc_number' => 'nullable',
            'nationality_country_id' => 'required',
            'type' => 'required',
            'commission_rate' => 'nullable',
            'status' => 'required',
            'company_id' => 'nullable',
            'country_id' => 'nullable',
            'email' => 'nullable|email|unique:agents',
            'mobile_number' => 'required',
            'phone' => 'nullable',
            'line' => 'nullable',
            'whatsapp' => 'nullable',
            'languages.*' => '',
            'doc_file' => '',
            'photo_file' => ''
        ];

        $method = $this->getMethod();
        if ($method == 'PUT') {
            $rules['email'] .= ",email,{$this->route('agent')}";
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
            'nationality_country_id' => 'nationality country',
            'mobile_number' => 'mobile'
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
            'last_name.required' => __('staff/validations.required'),
            'gender.required' => __('staff/validations.required'),
            'date_of_birth.required' => __('staff/validations.required'),
            'nationality_country_id.required' => __('staff/validations.required'),
            'type.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
            'email.email' => __('staff/validations.email'),
            'email.unique' => __('staff/validations.unique'),
            'mobile_number.required' => __('staff/validations.required'),
        ];
    }
}