<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_created_at') }}</label>
        <br />
        {{ !empty($contact->created_at) ? $contact->created_at->format('F d, Y H:i:s') : '' }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.contact_requests_select_status') }}</option>
                @foreach(['new', 'processed'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $contact->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.contact_requests_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_name') }}</label>
        <br />
        {{ $contact->name }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_business_name') }}</label>
        <br />
        {{ $contact->business_name }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_email') }}</label>
        <br />
        {{ $contact->email }}
    </div>
    
    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_phone') }}</label>
        <br />
        {{ $contact->phone }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.contact_requests_message') }}</label>
        <br />
        {{ $contact->message }}
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.contact_requests.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>