<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.customers_contact_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_email') }}</label>
            <br>
            {{ $customer->email }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_mobile') }}</label>
            <br>
            {{ $customer->mobile }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_phone') }}</label>
            <br>
            {{ $customer->phone }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_line') }}</label>
            <br>
            {{ $customer->line }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_contact_details_whatsapp') }}</label>
            <br>
            {{ $customer->whatsapp }} 
        </div>

        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.customers_contact_details_language') }}</label>
            <br>
            {{ $customer->language->english_name ?? null }} 
        </div>
    </div>
</div>