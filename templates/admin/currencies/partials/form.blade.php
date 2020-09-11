

<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.currencies_code') }}</label>
        <input type="text" class="form-control {{ $errors->has('code') ? 'is-invalid' : ''}}" name="code" value="{{ old('code', $currency->code ?? '') }}">
        {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group">
        <label>{{ __('staff/forms.currencies_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $currency->name ?? '') }}">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.currencies_symbol') }}</label>
        <input type="text" class="form-control {{ $errors->has('symbol') ? 'is-invalid' : ''}}" name="symbol" value="{{ old('symbol', $currency->symbol ?? '') }}">
        {!! $errors->first('symbol', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.currencies.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>