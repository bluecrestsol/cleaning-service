<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
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
            'area_unit' => 'required',
            'has_states' => 'nullable',
            'has_cities' => 'nullable',
            'has_districts' => 'nullable',
            'has_zip' => 'nullable',
            'currency_id' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => __('staff/validations.required'),
            'area_unit.required' => __('staff/validations.required')
        ];
    }
}
