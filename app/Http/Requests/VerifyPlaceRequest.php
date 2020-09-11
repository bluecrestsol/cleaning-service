<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyPlaceRequest extends FormRequest
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
            'code' => 'required|exists:places,code'
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
            'code.required' => __('staff/validations.required')
        ];
    }
}
