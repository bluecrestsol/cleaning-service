

<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.places_categories_type') }}</label>
        <div class="group-control {{ $errors->has('type') ? 'is-invalid' : ''}}">
            <select name="type" class="form-control kt-selectpicker {{ $errors->has('type') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.places_categories_select_type') }}</option>
                @foreach(['residential', 'commercial', 'public'] as $type)
                    <option value="{{ $type }}"
                        {{ old('type', $placesCategory->type ?? '') == $type ? 'selected' : '' }}>{{ __('staff/forms.places_categories_type_'.$type) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    @foreach ($languages as $language)
        <div class="form-group {{ $loop->last ? 'form-group-last' : '' }}">
            <label>{{ __('staff/forms.places_categories_name') }} ({{ $language->english_name }})</label>
            <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                {{ __('staff/forms.places_categories_language_status_'.$language->status_public) }}
            </span>
            <input type="text" class="form-control {{ $errors->has('name.'.$language->code) ? 'is-invalid' : ''}}" name="name[{{ $language->code }}]"
                value="{{ old('name.'.$language->code, (isset($placesCategory) ? $placesCategory->getTranslation('name', $language->code, false) : '')) }}">
            {!! $errors->first('name.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
        </div>
    @endforeach
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.places.categories.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>