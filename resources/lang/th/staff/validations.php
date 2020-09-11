<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'TH The :attribute must be accepted.',
    'active_url' => 'TH The :attribute is not a valid URL.',
    'after' => 'TH The :attribute must be a date after :date.',
    'after_or_equal' => 'TH The :attribute must be a date after or equal to :date.',
    'alpha' => 'TH The :attribute may only contain letters.',
    'alpha_dash' => 'TH The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'TH The :attribute may only contain letters and numbers.',
    'array' => 'TH The :attribute must be an array.',
    'before' => 'TH The :attribute must be a date before :date.',
    'before_or_equal' => 'TH The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'TH The :attribute must be between :min and :max.',
        'file' => 'TH The :attribute must be between :min and :max kilobytes.',
        'string' => 'TH The :attribute must be between :min and :max characters.',
        'array' => 'TH The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'TH The :attribute field must be true or false.',
    'confirmed' => 'TH The :attribute confirmation does not match.',
    'date' => 'TH The :attribute is not a valid date.',
    'date_equals' => 'TH The :attribute must be a date equal to :date.',
    'date_format' => 'TH The :attribute does not match the format :format.',
    'different' => 'TH The :attribute and :other must be different.',
    'digits' => 'TH The :attribute must be :digits digits.',
    'digits_between' => 'TH The :attribute must be between :min and :max digits.',
    'dimensions' => 'TH The :attribute has invalid image dimensions.',
    'distinct' => 'TH The :attribute field has a duplicate value.',
    'email' => 'TH The :attribute must be a valid email address.',
    'ends_with' => 'TH The :attribute must end with one of the following: :values',
    'exists' => 'TH The selected :attribute is invalid.',
    'file' => 'TH The :attribute must be a file.',
    'filled' => 'TH The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'TH The :attribute must be greater than :value.',
        'file' => 'TH The :attribute must be greater than :value kilobytes.',
        'string' => 'TH The :attribute must be greater than :value characters.',
        'array' => 'TH The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'TH The :attribute must be greater than or equal :value.',
        'file' => 'TH The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'TH The :attribute must be greater than or equal :value characters.',
        'array' => 'TH The :attribute must have :value items or more.',
    ],
    'image' => 'TH The :attribute must be an image.',
    'in' => 'TH The selected :attribute is invalid.',
    'in_array' => 'TH The :attribute field does not exist in :other.',
    'integer' => 'TH The :attribute must be an integer.',
    'ip' => 'TH The :attribute must be a valid IP address.',
    'ipv4' => 'TH The :attribute must be a valid IPv4 address.',
    'ipv6' => 'TH The :attribute must be a valid IPv6 address.',
    'json' => 'TH The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'TH The :attribute must be less than :value.',
        'file' => 'TH The :attribute must be less than :value kilobytes.',
        'string' => 'TH The :attribute must be less than :value characters.',
        'array' => 'TH The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'TH The :attribute must be less than or equal :value.',
        'file' => 'TH The :attribute must be less than or equal :value kilobytes.',
        'string' => 'TH The :attribute must be less than or equal :value characters.',
        'array' => 'TH The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'TH The :attribute may not be greater than :max.',
        'file' => 'TH The :attribute may not be greater than :max kilobytes.',
        'string' => 'TH The :attribute may not be greater than :max characters.',
        'array' => 'TH The :attribute may not have more than :max items.',
    ],
    'mimes' => 'TH The :attribute must be a file of type: :values.',
    'mimetypes' => 'TH The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'TH The :attribute must be at least :min.',
        'file' => 'TH The :attribute must be at least :min kilobytes.',
        'string' => 'TH The :attribute must be at least :min characters.',
        'array' => 'TH The :attribute must have at least :min items.',
    ],
    'not_in' => 'TH The selected :attribute is invalid.',
    'not_regex' => 'TH The :attribute format is invalid.',
    'numeric' => 'TH The :attribute must be a number.',
    'password' => 'TH The password is incorrect.',
    'present' => 'TH The :attribute field must be present.',
    'regex' => 'TH The :attribute format is invalid.',
    'required' => 'TH The :attribute field is required.',
    'required_if' => 'TH The :attribute field is required when :other is :value.',
    'required_unless' => 'TH The :attribute field is required unless :other is in :values.',
    'required_with' => 'TH The :attribute field is required when :values is present.',
    'required_with_all' => 'TH The :attribute field is required when :values are present.',
    'required_without' => 'TH The :attribute field is required when :values is not present.',
    'required_without_all' => 'TH The :attribute field is required when none of :values are present.',
    'same' => 'TH The :attribute and :other must match.',
    'size' => [
        'numeric' => 'TH The :attribute must be :size.',
        'file' => 'TH The :attribute must be :size kilobytes.',
        'string' => 'TH The :attribute must be :size characters.',
        'array' => 'TH The :attribute must contain :size items.',
    ],
    'starts_with' => 'TH The :attribute must start with one of the following: :values',
    'string' => 'TH The :attribute must be a string.',
    'timezone' => 'TH The :attribute must be a valid zone.',
    'unique' => 'TH The :attribute has already been taken.',
    'uploaded' => 'TH The :attribute failed to upload.',
    'url' => 'TH The :attribute format is invalid.',
    'uuid' => 'TH The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'address' => [
            'required' => 'โปรดระบุที่อยู่'
        ],
        'area_size' => [
            'required' => 'โปรดระบุขนาด'
        ],
        'attribute-name' => [
            'rule-name' => 'TH custom-message',
        ],
        'category' => [
            'required' => 'โปรดระบุประเภท'
        ],
        'customer_code' => [
            'empty' => 'TH Please enter customer code.',
            'exists' => 'TH Customer code not found.'
        ],
        'suffix_country_code' => 'TH The :attribute field has an invalid country code.',
        'form' => [
            'cannot' => 'TH Can\'t submit form at this moment.'
        ],
        'name' => [
            'required' => 'โปรดระบุชื่อ',
        ],
        'phone' => [
            'inline_invalid_number' => 'TH Invalid number',
            'inline_invalid_country_code' => 'TH Invalid country code',
            'inline_too_short' => 'TH Too short',
            'inline_too_long' => 'TH Too long',
            'invalid_number' => 'TH The :attribute field is an invalid number',
            'invalid_country_code' => 'TH The :attribute field has an invalid country code',
            'required' => 'โปรดระบุเบอร์โทรศัพท์',
            'too_short' => 'TH The :attribute field is too short',
            'too_long' => 'TH The :attribute field is too long',
        ],
        'property_type' => [
            'required' => 'โปรดระบุประเภทสถานประกอบการ'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
