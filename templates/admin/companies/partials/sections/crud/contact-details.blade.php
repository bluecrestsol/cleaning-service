<div class="kt-section">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_contact_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- phone --}}
        <div class="form-group">                                    
            <label>{{ __('staff/forms.companies_contact_details_phone') }}</label>
            <mobile :config="phone.config"
                initial="{{ old('phone') ?? $company->phone ?? '' }}"
                v-model="phone.value"
                :names="['phone_number', 'phone_country_code']"
                error="{{ $errors->first('phone') }}"
                @change="onPhoneChange">
            </mobile>
        </div>

        {{-- whatsapp --}}
        <div class="form-group">                                    
            <label>{{ __('staff/forms.companies_contact_details_whatsapp') }}</label>
            <mobile :config="whatsapp.config"
                initial="{{ old('whatsapp') ?? $company->whatsapp ?? '' }}"
                v-model="whatsapp.value"
                :names="['whatsapp_number', 'whatsapp_country_code']"
                error="{{ $errors->first('whatsapp') }}"
                @change="onWhatsappChange">
            </mobile>
        </div>

        {{-- line --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_line') }}</label>
            <input type="text" class="form-control {{ $errors->has('line') ? 'is-invalid' : ''}}" name="line" value="{{ old('line') ?? $company->line ?? '' }}">
            {!! $errors->first('line', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- facebook handle --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_facebook_handle') }}</label>
            <input type="text" class="form-control {{ $errors->has('facebook_username') ? 'is-invalid' : ''}}" name="facebook_username" value="{{ old('facebook_username', $company->facebook_username ?? '') }}">
            {!! $errors->first('facebook_username', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- customer service phone --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_customer_service_phone') }}</label>
            <input type="text" class="form-control {{ $errors->has('customer_service_phone') ? 'is-invalid' : ''}}" name="customer_service_phone"
                value="{{ old('customer_service_phone', $company->customer_service_phone ?? '') }}">
            {!! $errors->first('customer_service_phone', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        {{-- customer service email --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_contact_details_customer_service_email') }}</label>
            <input type="email" class="form-control {{ $errors->has('customer_service_email') ? 'is-invalid' : ''}}" name="customer_service_email"
                value="{{ old('customer_service_email', $company->customer_service_email ?? '') }}">
            {!! $errors->first('customer_service_email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>