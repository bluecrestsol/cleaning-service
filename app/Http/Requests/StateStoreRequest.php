<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateStoreRequest extends FormRequest
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
        $state = $this->route('state') ?? 'NULL';
        return [
            'country_id' => 'required',
            'name.*' => 'required|unique_translation:states,name,'.$state.',id,country_id,'.$this->country_id
        ];
    }
    
    public function attributes()
    {
        return [
            'country_id' => 'country',
            'name.*' => 'name'
        ];
    }
    

    public function messages()
    {
        return [
            'country_id.required' => __('staff/validations.required'),
            'name.*.required' => __('staff/validations.required'),
            'name.*.unique' => __('staff/validations.unique')
        ];
    }
}