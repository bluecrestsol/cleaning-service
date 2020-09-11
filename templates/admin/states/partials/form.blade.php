<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.states_country') }}</label> <i class="fa fa-spinner fa-spin" v-if="country.loading" style="margin-left: 5px;"></i>
        <select2
            name="country_id"
            initial="{{ old('country_id', $state->country_id ?? '') }}"
            v-model="country.value"
            :options.sync="country.options"
            :initial-options="{{ toSelect2Format($countries, ['id', 'name']) }}"
            placeholder="{{ __('staff/forms.states_select_country') }}"
            error="{{ $errors->first('country_id') }}"
        ></select2>
    </div>

    @foreach ($languages as $language)
        <div class="form-group {{ $loop->last ? 'form-group-last' : '' }}">
            <label>{{ __('staff/forms.states_name') }} ({{ $language->english_name }})</label>
            <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                {{ __('staff/forms.states_language_status_'.$language->status_public) }}
            </span>
            <input type="text" class="form-control {{ $errors->has('name.'.$language->code) ? 'is-invalid' : ''}}" name="name[{{ $language->code }}]"
                value="{{ old('name.'.$language->code, (isset($state) ? $state->getTranslation('name', $language->code, false) : '')) }}">
            {!! $errors->first('name.'.$language->code, '<div class="invalid-feedback">:message</div>') !!}
        </div>
    @endforeach
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.states.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>