<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.companies_address') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- address line 1 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_line_1') }}</label>
            <br>
            {{ $company->address->line_1 ?? null}} 
        </div>

        {{-- address line 2 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_line_2') }}</label>
            <br>
            {{ $company->address->line_2 ?? null }} 
        </div>

        {{-- city --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_city') }}</label>
            <br>
            {{ $company->address->city ?? null }} 
        </div>

        {{-- state --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_state') }}</label>
            <br>
            {{ $company->address->state ?? null }} 
        </div>

        {{-- zip --}}
        <div class="form-group">
            <label>{{ __('staff/forms.companies_address_zip') }}</label>
            <br>
            {{ $company->address->zip ?? null }} 
        </div>

        {{-- country --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.companies_address_country') }}</label>
            <br>
            {{ $company->address->country->name ?? null }} 
        </div>
    </div>
</div>