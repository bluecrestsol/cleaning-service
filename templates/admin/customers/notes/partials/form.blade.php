

<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.customers_notes_customer') }}</label>
        <br>
        {{ "{$customer->code} {$customer->first_name} {$customer->last_name}" }}
    </div>

    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.customers_notes_note') }}</label>
        <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : ''}}"
            name="message"
            rows="5">{{ old('message', $customerNote->message ?? '') }}</textarea>
        {!! $errors->first('message', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.customers.notes.index', $customer->id) }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>