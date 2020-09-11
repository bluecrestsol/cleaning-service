<div class="kt-section kt-section--last">
    {{-- section title --}}
    <h3 class="kt-section__title">{{ __('staff/forms.places_billing_details') }}</h3>
    {{-- section body --}}
    <div class="kt-section__body">
        {{-- first name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_first_name') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->first_name }} 
        </div>

        {{-- last name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_last_name') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->last_name }} 
        </div>

        {{-- email --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_email') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->email }} 
        </div>

        {{-- mobile --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_mobile') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->mobile }} 
        </div>

        {{-- phone --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_phone') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->phone }} 
        </div>

        {{-- invoice name --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_invoice_name') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->name }} 
        </div>

        {{-- tax code --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_tax_code') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->tax_code }} 
        </div>

        {{-- address line 1 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_address_line_1') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->line_1 ?? '' }} 
        </div>

        {{-- address line 2 --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_address_line_2') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->line_2 ?? '' }} 
        </div>

        {{-- city --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_address_city') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->city ?? '' }} 
        </div>

        {{-- state --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_address_state') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->state ?? '' }} 
        </div>

        {{-- zip --}}
        <div class="form-group">
            <label>{{ __('staff/forms.places_billing_details_address_zip') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->zip ?? '' }} 
        </div>

        {{-- country --}}
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.places_billing_details_address_country') }}</label>
            <br>
            {{ optional($place->billing_details ?? ($place->customer->billing_details ?? null))->address->country->name ?? '' }} 
        </div>
    </div>
</div>