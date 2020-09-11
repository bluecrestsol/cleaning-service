

<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.countries_code') }}</label>
        <br>
        {{ $country->code }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.countries_name') }}</label>
        <br>
        {{ $country->name }}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.countries_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-xselectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.countries_select_status') }}</option>
                @foreach(['enabled', 'disabled', 'draft'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $country->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.countries_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.countries_currency') }} </label> <i class="fa fa-spinner fa-spin" v-if="currency.loading" style="margin-left: 5px;"></i>
        <select2
            initial="{{ old('country_id', $country->currency_id ?? '') }}"
            name="currency_id"
            v-model="currency.value"
            :options.sync="currency.options"
            placeholder="{{ __('staff/forms.countries_currencies_select_currency') }}"
            :error.sync="currency.error"
        ></select2>
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.countries_area_unit') }}</label>
        <div class="group-control {{ $errors->has('area_unit') ? 'is-invalid' : ''}}">
            <select name="area_unit" class="form-control kt-selectpicker {{ $errors->has('area_unit') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.countries_select_area_unit') }}</option>
                @foreach(['sqm', 'sqf'] as $area_unit)
                    <option value="{{ $area_unit }}"
                        {{ old('area_unit', $country->area_unit ?? '') == $area_unit ? 'selected' : '' }}>{{ __('staff/forms.countries_area_unit_'.$area_unit) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('area_unit', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_has_states')}}</label>
        <v-switch
            name="has_states"
            initial={{ old('has_states', $country->has_states ?? '') }}
            :options="hasStates.options"
            v-model="hasStates.value"
        ></v-switch>
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_has_cities')}}</label>
        <v-switch
            name="has_cities"
            initial={{ old('has_cities', $country->has_cities ?? '') }}
            :options="hasCities.options"
            v-model="hasCities.value"
        ></v-switch>
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_has_districts')}}</label>
        <v-switch
            name="has_districts"
            initial={{ old('has_districts', $country->has_districts ?? '') }}
            :options="hasDistricts.options"
            v-model="hasDistricts.value"
        ></v-switch>
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_has_zip')}}</label>
        <v-switch
            name="has_zip"
            initial={{ old('has_zip', $country->has_zip ?? '') }}
            :options="hasZip.options"
            v-model="hasZip.value"
        ></v-switch>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.countries.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>
