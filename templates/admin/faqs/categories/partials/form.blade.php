

<div class="kt-portlet__body">
    @foreach ($languages as $language)
        <div class="form-group">
            <label>{{ __('staff/forms.faqs_categories_name') }} ({{ $language->english_name }})</label>
            <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                {{ __('staff/forms.faqs_categories_language_status_'.$language->status_public) }}
            </span>
            <input type="text" class="form-control {{ $errors->has('name.'.$language->code) ? 'is-invalid' : ''}}" name="name[{{ $language->code }}]"
                value="{{ old('name.'.$language->code, (isset($faqCategory) ? $faqCategory->getTranslation('name', $language->code, false) : '')) }}">
            {!! $errors->first('name.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
        </div>
    @endforeach

    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.faqs_categories_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.faqs_categories_select_status') }}</option>
                @foreach(['enabled', 'disabled'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $faqCategory->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.faqs_categories_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.faqs_categories.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>