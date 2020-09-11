

<div class="kt-portlet__body">
    @foreach (['name', 'description', 'public_name'] as $field)
        @foreach ($languages as $language)
            <div class="form-group">
                <label>{{ __('staff/forms.services_'.$field) }} ({{ $language->english_name }})</label>
                <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                    {{ __('staff/forms.services_language_status_'.$language->status_public) }}
                </span>
                <input type="text" class="form-control {{ $errors->has($field.'.'.$language->code) ? 'is-invalid' : ''}}" name="{{ $field }}[{{ $language->code }}]"
                    value="{{ old($field.'.'.$language->code, (isset($service) ? $service->getTranslation($field, $language->code, false) : '')) }}">
                {!! $errors->first($field.'.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
            </div>
        @endforeach
    @endforeach

    <div class="form-group">
        <label>{{ __('staff/forms.services_type') }}</label>
        <div class="group-control {{ $errors->has('type') ? 'is-invalid' : ''}}">
            <select name="type" class="form-control kt-selectpicker {{ $errors->has('type') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.services_select_type') }}</option>
                @foreach(['residential', 'commercial', 'public'] as $type)
                    <option value="{{ $type }}"
                        {{ old('type', $service->type ?? '') == $type ? 'selected' : '' }}>{{ __('staff/forms.services_type_'.$type) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.services_price') }}</label>
        <input type="text" class="form-control {{ $errors->has('price') ? 'is-invalid' : ''}}" name="price" value="{{ old('price', $service->price ?? '') }}">
        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.services_discount_price') }}</label>
        <input type="text" class="form-control {{ $errors->has('discounted_price') ? 'is-invalid' : ''}}" name="discounted_price" value="{{ old('discounted_price', $service->discounted_price ?? '') }}">
        {!! $errors->first('discounted_price', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.services_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.services_select_status') }}</option>
                @foreach(['enabled', 'disabled'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $service->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.services_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.services.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>