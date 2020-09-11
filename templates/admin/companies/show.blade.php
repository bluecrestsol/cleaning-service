@extends('layouts.admin.index')
@section('title',  __('staff/titles.companies_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-building"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.companies_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                {{-- section title --}}
                <h3 class="kt-section__title">{{ __('staff/forms.companies_general_details') }}</h3>
                {{-- section body --}}
                <div class="kt-section__body">
                    {{-- name --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_name') }}</label>
                        <br>
                        {{ $company->name }} 
                    </div>
                    {{-- country --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_country') }}</label>
                        <br>
                        {{ $company->country->name ?? '' }} 
                    </div>
                    {{-- registration number --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_registration_number') }}</label>
                        <br>
                        {{ $company->reg_number ?? '' }} 
                    </div>
                    {{-- website --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_website') }}</label>
                        <br>
                        {{ $company->website }} 
                    </div>
                    {{-- facebook --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_facebook') }}</label>
                        <br>
                        {{ $company->facebook }} 
                    </div>
                    {{-- instagram --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_instagram') }}</label>
                        <br>
                        {{ $company->instagram }} 
                    </div>
                    {{-- youtube --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.companies_youtube') }}</label>
                        <br>
                        {{ $company->youtube }} 
                    </div>
                    {{-- linked in --}}
                    <div class="form-group form-group-last">
                        <label>{{ __('staff/forms.companies_linkedin') }}</label>
                        <br>
                        {{ $company->linkedin }} 
                    </div>
                </div>
            </div>

            {{-- contact details related --}}
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.companies.partials.sections.show.contact-details')

            {{-- address related --}}
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.companies.partials.sections.show.address')

            {{-- billing details related --}}
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.companies.partials.sections.show.billing-details')

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

{{-- page scripts --}}
@section('page_script')
    <script src="{{ url('js/admin/companies/view.js') }}" type="text/javascript"></script>
@endsection