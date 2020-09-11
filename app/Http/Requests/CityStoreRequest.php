<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityStoreRequest extends FormRequest
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
        $city = $this->route('city') ?? 'NULL';
        return [
            'country_id' => 'required',
            'state_id' => 'required',
            'name.*' => 'required|unique_translation:cities,name,'.$city.',id,country_id,'.$this->country_id
                .',state_id,'.$this->state_id
        ];
    }
    
    public function attributes()
    {
        return [
            'country_id' => 'country',
            'state_id' => 'state',
            'name.*' => 'name'
        ];
    }

    public function messages()
    {
        return [
            'country_id.required' => __('staff/validations.required'),
            'state_id.required' => __('staff/validations.required'),
            'name.*.required' => __('staff/validations.required'),
            'name.*.unique' => __('staff/validations.unique')
        ];
    }
}