<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractStoreRequest extends FormRequest
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
            'customer_id' => 'required',
            'place_id' => 'required',
            'frequency' => 'required',
            'price_unit' => 'required',
            'price' => 'nullable|numeric',
            'started_at' => 'required',
            'ended_at' => 'required',
            'country_id' => '',
        ];
    }

    public function attributes()
    {
        return [
            'place_id' => 'place',
            'started_at' => 'starts at',
            'ended_at' => 'ends at',
        ];
    }

    public function messages()
    {
        return [
            'place_id.required' => __('staff/validations.required'),
            'frequency.required' => __('staff/validations.required'),
            'price_unit.required' => __('staff/validations.required'),
            'price.numeric' => __('staff/validations.numeric'),
            'started_at.required' => __('staff/validations.required'),
            'ended_at.required' => __('staff/validations.required'),
        ];
    }
}