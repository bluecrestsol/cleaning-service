<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.crew_members_contact_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_email') }}</label>
            <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $crewMember->email ?? '') }}">
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group">                                    
            <label>{{ __('staff/forms.crew_members_contact_details_mobile') }} *</label>
            <mobile :config="mobile.config"
                initial="{{ old('mobile_number', $crewMember->mobile_number ?? '') }}"
                v-model="mobile.value"
                :names="['mobile', 'mobile_country_code']"
                error="{{ $errors->first('mobile_number') }}"
                @change="onMobileChange">
            </mobile>
        </div>
        
        <div class="form-group">                                    
            <label>{{ __('staff/forms.crew_members_contact_details_phone') }}</label>
            <mobile :config="phone.config"
                initial="{{ old('phone', $crewMember->phone ?? '') }}"
                v-model="phone.value"
                :names="['phone_number', 'phone_country_code']"
                error="{{ $errors->first('phone') }}"
                @change="onPhoneChange">
            </mobile>
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_line') }}</label>
            <input type="text" class="form-control {{ $errors->has('line') ? 'is-invalid' : ''}}" name="line" value="{{ old('line', $crewMember->line ?? '') }}">
            {!! $errors->first('line', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="form-group form-group-last">                                    
            <label>{{ __('staff/forms.crew_members_contact_details_whatsapp') }}</label>
            <mobile :config="whatsapp.config"
                initial="{{ old('whatsapp', $crewMember->whatsapp ?? '') }}"
                v-model="whatsapp.value"
                :names="['whatsapp_number', 'whatsapp_country_code']"
                error="{{ $errors->first('whatsapp') }}"
                @change="onWhatsappChange">
            </mobile>
        </div>
    </div>
</div>