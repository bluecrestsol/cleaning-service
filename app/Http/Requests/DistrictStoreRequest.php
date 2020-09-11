<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DistrictStoreRequest extends FormRequest
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
        $district = $this->route('district') ?? 'NULL';
        return [
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'name.*' => 'required|unique_translation:districts,name,'.$district.',id,country_id,'.$this->country_id
                .',state_id,'.$this->state_id.',city_id,'.$this->city_id
        ];
    }

    public function attributes()
    {
        return [
            'country_id' => 'country',
            'state_id' => 'state',
            'city_id' => 'city',
            'name.*' => 'name'
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => __('staff/validations.required'),
            'state_id.required' => __('staff/validations.required'),
            'city_id.required' => __('staff/validations.required'),
            'name.*.required' => __('staff/validations.required'),
            'name.*.unique' => __('staff/validations.unique')
        ];
    }
}