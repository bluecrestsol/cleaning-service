<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_billing_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- first name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_first_name') }}</label>
            <br>
            {{ $company->billing_details->first_name ?? null }} 
        </div>

        {{-- last name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_last_name') }}</label>
            <br>
            {{ $company->billing_details->last_name ?? null }} 
        </div>

        {{-- email --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_email') }}</label>
            <br>
            {{ $company->billing_details->email ?? null }} 
        </div>

        {{-- mobile --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_mobile') }}</label>
            <br>
            {{ $company->billing_details->mobile ?? null }} 
        </div>

        {{-- phone --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_phone') }}</label>
            <br>
            {{ $company->billing_details->phone ?? null }} 
        </div>

        {{-- invoice name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_invoice_name') }}</label>
            <br>
            {{ $company->billing_details->name ?? null }} 
        </div>

        {{-- tax code --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_tax_code') }}</label>
            <br>
            {{ $company->billing_details->tax_code ?? null }} 
        </div>

        {{-- address line 1 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_line_1') }}</label>
            <br>
            {{ $company->billing_details->address->line_1 ?? null}} 
        </div>

        {{-- address line 2 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_line_2') }}</label>
            <br>
            {{ $company->billing_details->address->line_2 ?? null }} 
        </div>

        {{-- city --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_city') }}</label>
            <br>
            {{ $company->billing_details->address->city ?? null }} 
        </div>

        {{-- state --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_state') }}</label>
            <br>
            {{ $company->billing_details->address->state ?? null }} 
        </div>

        {{-- zip --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_billing_details_address_zip') }}</label>
            <br>
            {{ $company->billing_details->address->zip ?? null }} 
        </div>

        {{-- country --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_billing_details_address_country') }}</label>
            <br>
            {{ $company->billing_details->address->country->name ?? null }} 
        </div>
    </div>
</div>