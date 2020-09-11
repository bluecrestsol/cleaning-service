<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.languages_code') }}</label>
        <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}" name="code" value="{{ old('code', $language->code ?? '') }}" >
        {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.languages_english_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('english_name') ? 'is-invalid' : ''}}" name="english_name" value="{{ old('english_name', $language->english_name ?? '') }}" >
        {!! $errors->first('english_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.languages_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $language->name ?? '') }}" >
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.languages_status_public') }}</label>
        <div class="group-control {{ $errors->has('status_public') ? 'is-invalid' : ''}}">
            <select name="status_public" class="form-control kt-selectpicker {{ $errors->has('status_public') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.languages_select_status') }}</option>
                @foreach(['enabled', 'disabled', 'draft'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status_public', $language->status_public ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.languages_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status_public', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.languages_status_staff') }}</label>
        <div class="group-control {{ $errors->has('status_staff') ? 'is-invalid' : ''}}">
            <select name="status_staff" class="form-control kt-selectpicker {{ $errors->has('status_staff') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.languages_select_status') }}</option>
                @foreach(['enabled', 'disabled'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status_staff', $language->status_staff ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.languages_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status_staff', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.languages.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>