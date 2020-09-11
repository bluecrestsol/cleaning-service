<div class="kt-portlet__body">
    <collection
        variables='<?php echo json_encode([
            "company" => $company,
            "country" => $country ?? null
        ]); ?>'>
    </collection>
    <div class="form-group">
        <label>{{ __('staff/forms.companies_countries_country') }}</label> <i class="fa fa-spinner fa-spin" v-if="country.loading" style="margin-left: 5px;"></i>
        <select2
            name="country_id"
            initial="{{ old('country_id', $country->id ?? '') }}"
            v-model="country.value"
            :options.sync="country.options"
            placeholder="{{ __('staff/forms.companies_countries_select_country') }}"
            error="{{ $errors->first('country_id') }}"
        ></select2>
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.companies.countries.index', $company->id) }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>