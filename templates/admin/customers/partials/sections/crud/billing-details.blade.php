<div class="kt-section kt-section--last">
    <h3 class="kt-section__title">{{ __('staff/forms.customers_billing_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_first_name') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.first_name') ? 'is-invalid' : ''}}" name="billing_details[first_name]" value="{{ old('billing_details.first_name', $customer->billing_details->first_name ?? '') }}">
            {!! $errors->first('billing_details.first_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_last_name') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.last_name') ? 'is-invalid' : ''}}" name="billing_details[last_name]" value="{{ old('billing_details.last_name', $customer->billing_details->last_name ?? '') }}">
            {!! $errors->first('billing_details.last_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_email') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.email') ? 'is-invalid' : ''}}" name="billing_details[email]" value="{{ old('billing_details.email', $customer->billing_details->email ?? '') }}">
            {!! $errors->first('billing_details.email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">                                    
            <label>{{ __('staff/forms.customers_billing_details_mobile') }}</label>
            <mobile :config="billingDetails.mobile.config"
                initial="{{ old('billing_details.mobile', $customer->billing_details->mobile ?? '') }}"
                v-model="billingDetails.mobile.value"
                :names="['billing_details[mobile_number]', 'billing_details[mobile_country_code]']"
                error="{{ $errors->first('billing_details.mobile') }}"
                @change="onBillingDetailsMobileChange">
            </mobile>
        </div> 

        <div class="form-group">                                    
            <label>{{ __('staff/forms.customers_billing_details_phone') }}</label>
            <mobile :config="billingDetails.phone.config"
                initial="{{ old('billing_details.phone', $customer->billing_details->phone ?? '') }}"
                v-model="billingDetails.phone.value"
                :names="['billing_details[phone_number]', 'billing_details[phone_country_code]']"
                error="{{ $errors->first('billing_details.phone') }}"
                @change="onBillingDetailsPhoneChange">
            </mobile>
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_invoice_name') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.name') ? 'is-invalid' : ''}}" name="billing_details[name]" value="{{ old('billing_details.name', $customer->billing_details->name ?? '') }}">
            {!! $errors->first('billing_details.name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_tax_code') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.tax_code') ? 'is-invalid' : ''}}" name="billing_details[tax_code]" value="{{ old('billing_details.tax_code', $customer->billing_details->tax_code ?? '') }}">
            {!! $errors->first('billing_details.tax_code', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_line_1') }}</label>
            <input type="text" class="form-control {{ $errors->has("billing_details.address.line_1") ? 'is-invalid' : ''}}" name="billing_details[address][line_1]" value="{{ old('billing_details.address.line_1', $customer->billing_details->address->line_1 ?? '') }}">
            {!! $errors->first('billing_details.address.line_1', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_line_2') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.line_2') ? 'is-invalid' : ''}}" name="billing_details[address][line_2]" value="{{ old('billing_details.address.line_2', $customer->billing_details->address->line_2 ?? '') }}">
            {!! $errors->first('billing_details.address.line_2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_city') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.city') ? 'is-invalid' : ''}}" name="billing_details[address][city]" value="{{ old('billing_details.address.city', $customer->billing_details->address->city ?? '') }}">
            {!! $errors->first('billing_details.address.city', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_state') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.state') ? 'is-invalid' : ''}}" name="billing_details[address][state]" value="{{ old('billing_details.address.state', $customer->billing_details->address->state ?? '') }}">
            {!! $errors->first('billing_details.address.state', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_zip') }}</label>
            <input type="text" class="form-control {{ $errors->has('billing_details.address.zip') ? 'is-invalid' : ''}}" name="billing_details[address][zip]" value="{{ old('billing_details.address.zip', $customer->billing_details->address->zip ?? '') }}">
            {!! $errors->first('billing_details.address.zip', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.customers_billing_details_address_country') }}</label> <i class="fa fa-spinner fa-spin" v-if="billingDetails.address.country.loading" style="margin-left: 5px;"></i>
            <select2
                name="billing_details[address][country_id]"
                initial="{{ old('billing_details.address.country_id', $customer->billing_details->address->country_id ?? $admin->active_country_id) }}"
                v-model="billingDetails.address.country.value"
                :options.sync="billingDetails.address.country.options"
                placeholder="{{ __('staff/forms.customers_billing_details_address_select_country') }}"
                error="{{ $errors->first('billing_details.address.country_id') }}"
            ></select2>
        </div>
    </div>
</div>