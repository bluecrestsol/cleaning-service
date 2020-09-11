<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * FAQs question store form request
 */
class FaqStoreRequest extends FormRequest
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
            'faq_category_id' => 'required',
            'question.*' => 'required',
            'answer.*' => 'required',
            'status' => 'required',
        ];
    }

    /**
     * list of attributes to be changed on display
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'faq_category_id' => 'category',
            'question.*' => 'question',
            'answer.*' => 'answer',
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
            'faq_category_id.required' => __('staff/validations.required'),
            'question.*.required' => __('staff/validations.required'),
            'answer.*.required' => __('staff/validations.required'),
            'status.required' => __('staff/validations.required'),
        ];
    }
    
    /**
     * Pre validation logic
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $category = $this->route('faqs_category');
        if (isset($category)) {
            $this->merge([
                'faq_category_id' => $category
            ]);
        }
    }
}