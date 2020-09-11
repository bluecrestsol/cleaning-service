<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.places_billing_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- use customer's billing details switch --}}
        <div class="form-group">
            <label>{{__('staff/forms.places_billing_details_use_customer')}}</label>
            <v-switch
                :options="billingDetails.useCustomer.options"
                v-model="billingDetails.useCustomer.value"
            ></v-switch>
        </div>
        
        {{-- if not using customer's billing details --}}
        <template v-if="useCustomer == '0'">
            {{-- first name field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_first_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.first_name') ? 'is-invalid' : '' }}" name="billing_details[first_name]" value="{{ old('billing_details.first_name', $place->billing_details->first_name ?? '') }}">
                {!! $errors->first('billing_details.first_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- last name field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_last_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.last_name') ? 'is-invalid' : '' }}" name="billing_details[last_name]" value="{{ old('billing_details.last_name', $place->billing_details->last_name ?? '') }}">
                {!! $errors->first('billing_details.last_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- email field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_email') }} *</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.email') ? 'is-invalid' : '' }}" name="billing_details[email]" value="{{ old('billing_details.email', $place->billing_details->email ?? '') }}">
                {!! $errors->first('billing_details.email', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- mobile field --}}
            <div class="form-group">                                    
                <label>{{ __('staff/forms.places_billing_details_mobile') }} *</label>
                <mobile :config="billingDetails.mobile.config"
                    initial="{{ old('billing_details.mobile', $place->billing_details->mobile ?? '') }}"
                    v-model="billingDetails.mobile.value"
                    :names="['billing_details[mobile_number]', 'billing_details[mobile_country_code]']"
                    error="{{ $errors->first('billing_details.mobile') }}"
                    @change="onBillingDetailsMobileChange">
                </mobile>
            </div> 

            {{-- phone field --}}
            <div class="form-group">                                    
                <label>{{ __('staff/forms.places_billing_details_phone') }}</label>
                <mobile :config="billingDetails.phone.config"
                    initial="{{ old('billing_details.phone', $place->billing_details->phone ?? '') }}"
                    v-model="billingDetails.phone.value"
                    :names="['billing_details[phone_number]', 'billing_details[phone_country_code]']"
                    error="{{ $errors->first('billing_details.phone') }}"
                    @change="onBillingDetailsPhoneChange">
                </mobile>
            </div>

            {{-- invoice name field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_invoice_name') }} *</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.name') ? 'is-invalid' : ''}}" name="billing_details[name]" value="{{ old("billing_details.name", $place->billing_details->name ?? '') }}">
                {!! $errors->first('billing_details.name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- tax code field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_tax_code') }}</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.tax_code') ? 'is-invalid' : ''}}" name="billing_details[tax_code]" value="{{ old('billing_details.tax_code', $place->billing_details->tax_code ?? '') }}">
                {!! $errors->first('billing_details.tax_code', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- address line 1 field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_line_1') }} *</label>
                <input type="text" class="form-control {{ $errors->has("billing_details.address.line_1") ? 'is-invalid' : ''}}" name="billing_details[address][line_1]" value="{{ old('billing_details.address.line_1', $place->billing_details->address->line_1 ?? '') }}">
                {!! $errors->first('billing_details.address.line_1', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- address line 2 field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_line_2') }}</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.address.line_2') ? 'is-invalid' : ''}}" name="billing_details[address][line_2]" value="{{ old('billing_details.address.line_2', $place->billing_details->address->line_2 ?? '') }}">
                {!! $errors->first('billing_details.address.line_2', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- city field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_city') }} *</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.address.city') ? 'is-invalid' : ''}}" name="billing_details[address][city]" value="{{ old('billing_details.address.city', $place->billing_details->address->city ?? '') }}">
                {!! $errors->first('billing_details.address.city', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- state field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_state') }} *</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.address.state') ? 'is-invalid' : ''}}" name="billing_details[address][state]" value="{{ old('billing_details.address.state', $place->billing_details->address->state ?? '') }}">
                {!! $errors->first('billing_details.address.state', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- zip field --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_zip') }} *</label>
                <input type="text" class="form-control {{ $errors->has('billing_details.address.zip') ? 'is-invalid' : ''}}" name="billing_details[address][zip]" value="{{ old('billing_details.address.zip', $place->billing_details->address->zip ?? '') }}">
                {!! $errors->first('billing_details.address.zip', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- country field --}}
            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.places_billing_details_address_country') }} *</label> <i class="fa fa-spinner fa-spin" v-if="billingDetails.address.country.loading" style="margin-left: 5px;"></i>
                <select2
                    name="billing_details[address][country_id]"
                    initial="{{ old('billing_details.address.country_id', $place->billing_details->address->country_id ?? $admin->active_country_id) }}"
                    v-model="billingDetails.address.country.value"
                    :options.sync="billingDetails.address.country.options"
                    placeholder="{{ __('staff/forms.places_billing_details_address_select_country') }}"
                    error="{{ $errors->first('billing_details.address.country_id') }}"
                ></select2>
            </div>
        </template>
        
        {{-- if using customer's billing detials --}}
        <template v-else-if="useCustomer !== '0' && customerBillingDetails">
            {{-- first name --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_first_name') }}</label>
                <br>
                @{{ customerBillingDetails.first_name }}
            </div>

            {{-- last name --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_last_name') }}</label>
                <br>
                @{{ customerBillingDetails.last_name }}
            </div>

            {{-- email --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_email') }}</label>
                <br>
                @{{ customerBillingDetails.email }}
            </div>

            {{-- mobile --}}
            <div class="form-group">                                    
                <label>{{ __('staff/forms.places_billing_details_mobile') }}</label>
                <br>
                @{{ customerBillingDetails.mobile }}
            </div> 

            {{-- phone --}}
            <div class="form-group">                                    
                <label>{{ __('staff/forms.places_billing_details_phone') }}</label>
                <br>
                @{{ customerBillingDetails.phone }}
            </div>

            {{-- name --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_invoice_name') }}</label>
                <br>
                @{{ customerBillingDetails.name }}
            </div>

            {{-- tax code --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_tax_code') }}</label>
                <br>
                @{{ customerBillingDetails.tax_code }}
            </div>

            {{-- address line 1 --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_line_1') }}</label>
                <br>
                @{{ customerBillingDetails.address.line_1 }}
            </div>

            {{-- address line 2 --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_line_2') }}</label>
                <br>
                @{{ customerBillingDetails.address.line_2 }}
            </div>

            {{-- city --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_city') }}</label>
                <br>
                @{{ customerBillingDetails.address.city }}
            </div>

            {{-- state --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_state') }}</label>
                <br>
                @{{ customerBillingDetails.address.state }}
            </div>

            {{-- zip --}}
            <div class="form-group">
                <label>{{ __('staff/forms.places_billing_details_address_zip') }}</label>
                <br>
                @{{ customerBillingDetails.address.zip }}
            </div>

            {{-- country --}}
            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.places_billing_details_address_country') }}</label> <i class="fa fa-spinner fa-spin" v-if="billingDetails.address.country.loading" style="margin-left: 5px;"></i>
                <br>
                @{{ customerBillingDetails.address.country.name }}
            </div>
        </template>
    </div>
</div>