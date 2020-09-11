<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.customers_contact_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_email') }}</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $customer->email ?? '') }}">
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">                                    
            <label>{{ __('staff/forms.customers_contact_details_mobile') }} *</label>
            <mobile :config="mobile.config"
                initial="{{ old('mobile', $customer->mobile ?? '') }}"
                v-model="mobile.value"
                :names="['mobile_number', 'mobile_country_code']"
                error="{{ $errors->first('mobile') }}"
                @change="onMobileChange">
            </mobile>
        </div> 

        <div class="form-group">                                    
            <label>{{ __('staff/forms.customers_contact_details_phone') }}</label>
            <mobile :config="phone.config"
                initial="{{ old('phone', $customer->phone ?? '') }}"
                v-model="phone.value"
                :names="['phone_number', 'phone_country_code']"
                error="{{ $errors->first('phone') }}"
                @change="onPhoneChange">
            </mobile>
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_line') }}</label>
            <input type="text" class="form-control {{ $errors->has('line') ? 'is-invalid' : ''}}" name="line" value="{{ old('line', $customer->line ?? '') }}">
            {!! $errors->first('line', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">                                    
            <label>{{ __('staff/forms.customers_contact_details_whatsapp') }}</label>
            <mobile :config="whatsapp.config"
                initial="{{ old('whatsapp', $customer->whatsapp ?? '') }}"
                v-model="whatsapp.value"
                :names="['whatsapp_number', 'whatsapp_country_code']"
                error="{{ $errors->first('whatsapp') }}"
                @change="onWhatsappChange">
            </mobile>
        </div>

        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.customers_contact_details_language') }} *</label> <i class="fa fa-spinner fa-spin" v-if="language.loading" style="margin-left: 5px;"></i>
            <select2
                name="language_id"
                initial="{{ old('language_id', $customer->language_id ?? '') }}"
                v-model="language.value"
                :options.sync="language.options"
                placeholder="{{ __('staff/forms.customers_contact_details_select_language') }}"
                error="{{ $errors->first('language_id') }}"
            ></select2>
        </div>
    </div>
</div>