

<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.faqs_questions_category') }} </label> <i class="fa fa-spinner fa-spin" v-if="category.loading" style="margin-left: 5px;"></i>
        <select2
            name="faq_category_id"
            initial="{{ old('faq_category_id', $faqQuestion->faq_category_id ?? '') }}"
            v-model="category.value"
            :options.sync="category.options"
            placeholder="{{ __('staff/forms.faqs_questions_select_category') }}"
            error="{{ $errors->first('faq_category_id') }}"
        ></select2>
    </div>

    @foreach ($languages as $language)
        <div class="form-group">
            <label>{{ __('staff/forms.faqs_questions_question') }} ({{ $language->english_name }})</label>
            <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                {{ __('staff/forms.faqs_questions_language_status_'.$language->status_public) }}
            </span>
            <input type="text" class="form-control {{ $errors->has('question.'.$language->code) ? 'is-invalid' : ''}}" name="question[{{ $language->code }}]"
                value="{{ old('question.'.$language->code, (isset($faqQuestion) ? $faqQuestion->getTranslation('question', $language->code, false) : '')) }}">
            {!! $errors->first('question.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.faqs_questions_answer') }} ({{ $language->english_name }})</label>
            <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                {{ __('staff/forms.faqs_questions_language_status_'.$language->status_public) }}
            </span>
            <textarea class="form-control {{ $errors->has('answer.'.$language->code) ? 'is-invalid' : ''}}"
                name="answer[{{ $language->code }}]"
                rows="5">{{ old('answer.'.$language->code, (isset($faqQuestion) ? $faqQuestion->getTranslation('answer', $language->code, false) : '')) }}</textarea>
            {!! $errors->first('answer.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
        </div>
    @endforeach

    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.faqs_questions_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.faqs_questions_select_status') }}</option>
                @foreach(['enabled', 'disabled'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $faqQuestion->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.faqs_questions_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.faqs_questions.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>