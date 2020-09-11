<div class="kt-section kt-section--last">
    <h3 class="kt-section__title">{{ __('staff/forms.customers_billing_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_first_name') }}</label>
            <br>
            {{ $customer->billing_details->first_name ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_last_name') }}</label>
            <br>
            {{ $customer->billing_details->last_name ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_email') }}</label>
            <br>
            {{ $customer->billing_details->email ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_mobile') }}</label>
            <br>
            {{ $customer->billing_details->mobile ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_phone') }}</label>
            <br>
            {{ $customer->billing_details->phone ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_invoice_name') }}</label>
            <br>
            {{ $customer->billing_details->name ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_tax_code') }}</label>
            <br>
            {{ $customer->billing_details->tax_code ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_line_1') }}</label>
            <br>
            {{ $customer->billing_details->address->line_1 ?? null}} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_line_2') }}</label>
            <br>
            {{ $customer->billing_details->address->line_2 ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_city') }}</label>
            <br>
            {{ $customer->billing_details->address->city ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_state') }}</label>
            <br>
            {{ $customer->billing_details->address->state ?? null }} 
        </div>

        <div class="form-group">
            <label>{{ __('staff/forms.customers_billing_details_address_zip') }}</label>
            <br>
            {{ $customer->billing_details->address->zip ?? null }} 
        </div>

        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.customers_billing_details_address_country') }}</label>
            <br>
            {{ $customer->billing_details->address->country->name ?? null }} 
        </div>
    </div>
</div>