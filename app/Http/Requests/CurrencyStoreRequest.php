<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
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
            'code' => 'required|unique:currencies',
            'name' => 'required|unique:currencies',
            'symbol' => 'required|unique:currencies'
        ];
        
        $method = $this->getMethod();
        if ($method == 'PUT') {
            $id = $this->route('currency');

            foreach ($rules as $key => &$rule) {
                $rule = "{$rule},{$key},{$id}";
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'code.required' => __('staff/validations.required'),
            'name.required' => __('staff/validations.required'),
            'symbol.required' => __('staff/validations.required'),
            'code.unique' => __('staff/validations.unique'),
            'name.unique' => __('staff/validations.unique'),
            'symbol.unique' => __('staff/validations.unique')
        ];
    }
}