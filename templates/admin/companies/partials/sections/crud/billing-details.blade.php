<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_billing_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- first name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_first_name') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.first_name') ? 'is-invalid' : ''}}" name="billing_details[first_name]" value="{{ old('billing_details.first_name', $company->billing_details->first_name ?? '') }}">
            {!! $errors->first('billing_details.first_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- last name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_last_name') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.last_name') ? 'is-invalid' : ''}}" name="billing_details[last_name]" value="{{ old('billing_details.last_name', $company->billing_details->last_name ?? '') }}">
            {!! $errors->first('billing_details.last_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- email --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_email') }} *</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.email') ? 'is-invalid' : ''}}" name="billing_details[email]" value="{{ old('billing_details.email', $company->billing_details->email ?? '') }}">
            {!! $errors->first('billing_details.email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- mobile --}}
        <div class="form-group">                                    
            <label>{{ __('staff/forms.companies_billing_details_mobile') }} *</label>
            <mobile :config="billingDetails.mobile.config"
                initial="{{ old('billing_details.mobile', $company->billing_details->mobile ?? '') }}"
                v-model="billingDetails.mobile.value"
                :names="['billing_details[mobile_number]', 'billing_details[mobile_country_code]']"
                error="{{ $errors->first('billing_details.mobile') }}"
                @change="onBillingDetailsMobileChange">
            </mobile>
        </div> 

        {{-- phone --}}
        <div class="form-group">                                    
            <label>{{ __('staff/forms.companies_billing_details_phone') }}</label>
            <mobile :config="billingDetails.phone.config"
                initial="{{ old('billing_details.phone', $company->billing_details->phone ?? '') }}"
                v-model="billingDetails.phone.value"
                :names="['billing_details[phone_number]', 'billing_details[phone_country_code]']"
                error="{{ $errors->first('billing_details.phone') }}"
                @change="onBillingDetailsPhoneChange">
            </mobile>
        </div>

        {{-- invoice name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_invoice_name') }} *</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.name') ? 'is-invalid' : ''}}" name="billing_details[name]" value="{{ old('billing_details.name', $company->billing_details->name ?? '') }}">
            {!! $errors->first('billing_details.name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- tax code --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_tax_code') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.tax_code') ? 'is-invalid' : ''}}" name="billing_details[tax_code]" value="{{ old('billing_details.tax_code', $company->billing_details->tax_code ?? '') }}">
            {!! $errors->first('billing_details.tax_code', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- address line 1 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_line_1') }} *</label>
            <input type="text" class="form-control {{ $errors->has("billing_details.address.line_1") ? 'is-invalid' : ''}}" name="billing_details[address][line_1]" value="{{ old('billing_details.address.line_1', $company->billing_details->address->line_1 ?? '') }}">
            {!! $errors->first('billing_details.address.line_1', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- address line 2 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_line_2') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.line_2') ? 'is-invalid' : ''}}" name="billing_details[address][line_2]" value="{{ old('billing_details.address.line_2', $company->billing_details->address->line_2 ?? '') }}">
            {!! $errors->first('billing_details.address.line_2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- city --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_city') }} *</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.city') ? 'is-invalid' : ''}}" name="billing_details[address][city]" value="{{ old('billing_details.address.city', $company->billing_details->address->city ?? '') }}">
            {!! $errors->first('billing_details.address.city', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_state') }} *</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.state') ? 'is-invalid' : ''}}" name="billing_details[address][state]" value="{{ old('billing_details.address.state', $company->billing_details->address->state ?? '') }}">
            {!! $errors->first('billing_details.address.state', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- zip --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_zip') }} *</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.zip') ? 'is-invalid' : ''}}" name="billing_details[address][zip]" value="{{ old('billing_details.address.zip', $company->billing_details->address->zip ?? '') }}">
            {!! $errors->first('billing_details.address.zip', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- country --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_billing_details_address_country') }} *</label> <i class="fa fa-spinner fa-spin" v-if="billingDetails.address.country.loading" style="margin-left: 5px;"></i>
            <select2
                name="billing_details[address][country_id]"
                initial="{{ old('billing_details.address.country_id', $company->billing_details->address->country_id ?? $admin->active_country_id) }}"
                v-model="billingDetails.address.country.value"
                :options.sync="billingDetails.address.country.options"
                placeholder="{{ __('staff/forms.companies_billing_details_address_select_country') }}"
                error="{{ $errors->first('billing_details.address.country_id') }}"
            ></select2>
        </div>
    </div>
</div>