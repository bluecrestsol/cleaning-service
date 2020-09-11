<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'customer_id' => 'required',
            'place_id' => 'required',
            'contract_id' => 'nullable',
            'ordered_at' => 'required',
            'scheduled_at' => 'required',
            'serviced_at' => 'required',
            'services' => 'nullable',
            'crew.leader' => 'required',
            'crew.members' => 'nullable',
            'currency_id' => 'required',
            'price' => 'nullable|numeric',
            'payment_term' => 'required',
            'payment_due_at' => 'required_if:payment_term,postpaid',
            'payment_method' => 'required',
            'country_id' => 'nullable'
        ];
    }

    protected function prepareForValidation()
    {
        if (isset($this->payment_term) && $this->payment_term != 'postpaid') {
            $this->merge([
                'payment_due_at' => null
            ]);
        }
    }

    public function attributes()
    {
        return [
            'place_id' => 'place',
            'contract_id' => 'contract',
            'currency_id' => 'currency',
            'crew.leader' => 'crew leader',
            'payment_term' => 'payment terms',
            'payment_due_at' => 'payment date',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => __('staff/validations.required'),
            'place_id.required' => __('staff/validations.required'),
            'ordered_at.required' => __('staff/validations.required'),
            'scheduled_at.required' => __('staff/validations.required'),
            'serviced_at.required' => __('staff/validations.required'),
            'crew.leader.required' => __('staff/validations.required'),
            'currency_id.required' => __('staff/validations.required'),
            'price.numeric' => __('staff/validations.numeric'),
            'payment_terms.required' => __('staff/validations.required'),
            'paid_at.required_if' => __('staff/validations.required_if'),
            'payment_method.required' => __('staff/validations.required'),
        ];
    }
}