<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Agent store form request
 */
class NoteStoreRequest extends FormRequest
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
            'message' => 'required'
        ];
    }

    /**
     * list of attributes to be changed on display
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * list of validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'message.required' => __('staff/validations.required'),
        ];
    }
}