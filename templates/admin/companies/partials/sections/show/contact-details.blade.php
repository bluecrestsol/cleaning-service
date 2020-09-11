<div class="kt-section">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_contact_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- phone --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_phone') }}</label>
            <br>
            {{ $company->phone }} 
        </div>

        {{-- whatsapp --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_whatsapp') }}</label>
            <br>
            {{ $company->whatsapp }} 
        </div>

        {{-- line --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_line') }}</label>
            <br>
            {{ $company->line }} 
        </div>

        {{-- facebook handle --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_facebook_handle') }}</label>
            <br>
            {{ $company->facebook_username }} 
        </div>

        {{-- customer service phone --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_contact_details_customer_service_phone') }}</label>
            <br>
            {{ $company->customer_service_phone }} 
        </div>

        {{-- customer service email --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_contact_details_customer_service_email') }}</label>
            <br>
            {{ $company->customer_service_email }} 
        </div>
    </div>
</div>