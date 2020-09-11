<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_address') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- address line 1 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_line_1') }} *</label>
            <input type="text" class="form-control {{ $errors->has("address.line_1") ? 'is-invalid' : ''}}" name="address[line_1]" value="{{ old('address.line_1', $company->address->line_1 ?? '') }}">
            {!! $errors->first('address.line_1', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- address line 2 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_line_2') }}</label>
            <input type="text" class="form-control {{ $errors->has('address.line_2') ? 'is-invalid' : ''}}" name="address[line_2]" value="{{ old('address.line_2', $company->address->line_2 ?? '') }}">
            {!! $errors->first('address.line_2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- city --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_city') }} *</label>
            <input type="text" class="form-control {{ $errors->has('address.city') ? 'is-invalid' : ''}}" name="address[city]" value="{{ old('address.city', $company->address->city ?? '') }}">
            {!! $errors->first('address.city', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- state --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_state') }} *</label>
            <input type="text" class="form-control {{ $errors->has('address.state') ? 'is-invalid' : ''}}" name="address[state]" value="{{ old('address.state', $company->address->state ?? '') }}">
            {!! $errors->first('address.state', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- zip --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_zip') }} *</label>
            <input type="text" class="form-control {{ $errors->has('address.zip') ? 'is-invalid' : ''}}" name="address[zip]" value="{{ old('address.zip', $company->address->zip ?? '') }}">
            {!! $errors->first('address.zip', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- country --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_address_country') }} *</label> <i class="fa fa-spinner fa-spin" v-if="address.country.loading" style="margin-left: 5px;"></i>
            <select2
                name="address[country_id]"
                initial="{{ old('address.country_id', $company->address->country_id ?? $admin->active_country_id) }}"
                v-model="address.country.value"
                :options.sync="address.country.options"
                placeholder="{{ __('staff/forms.companies_address_select_country') }}"
                error="{{ $errors->first('address.country_id') }}"
            ></select2>
        </div>
    </div>
</div>