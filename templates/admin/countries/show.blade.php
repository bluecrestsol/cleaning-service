@extends('layouts.admin.index')
@section('title',  __('staff/titles.countries_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.countries_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.countries_code') }}</label>
                <br />
                {{ $country->code }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_name') }}</label>
                <br />
                {{ $country->name }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_has_states') }}</label>
                <br />
                <span class="kt-badge kt-badge--inline {{ (isset($country->has_states) && $country->has_states == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.countries_has_states_'.(isset($country->has_states) && $country->has_states == '1' ? 'yes' : 'no' )) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_has_cities') }}</label>
                <br />
                <span class="kt-badge kt-badge--inline {{ (isset($country->has_cities) && $country->has_cities == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.countries_has_cities_'.(isset($country->has_cities) && $country->has_cities == '1' ? 'yes' : 'no' )) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_has_districts') }}</label>
                <br />
                <span class="kt-badge kt-badge--inline {{ (isset($country->has_districts) && $country->has_districts == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.countries_has_districts_'.(isset($country->has_districts) && $country->has_districts == '1' ? 'yes' : 'no' )) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_has_zip') }}</label>
                <br />
                <span class="kt-badge kt-badge--inline {{ (isset($country->has_zip) && $country->has_zip == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.countries_has_zip_'.(isset($country->has_zip) && $country->has_zip == '1' ? 'yes' : 'no' )) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_status') }}</label>
                <br />
                <span class="kt-badge kt-badge--inline {{ $country->status == 'enabled' ? 'kt-badge--success' : ($country->status == 'disabled' ? 'kt-badge--danger' : 'kt-badge--warning') }}">{{ __('staff/forms.countries_status_'.$country->status) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_area_unit') }}</label>
                <br />
                {{ isset($country->area_unit) ? __('staff/forms.countries_area_unit_'.$country->area_unit) : '' }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_languages') }}</label>
                <br />
                @foreach ($country->languages as $language)
                    <span class="kt-badge kt-badge--inline kt-badge--{{ (isset($language->pivot) && isset($language->pivot->is_primary) && $language->pivot->is_primary == 1) ? 'primary' : 'success' }}">{{ $language->english_name }}</span>
                @endforeach
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.countries_currency') }}</label>
                <br />
                {{ optional($country->currency)->name }}
            </div>

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/countries/view.js') }}" type="text/javascript"></script>
@endsection
