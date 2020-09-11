@extends('layouts.admin.index')
@section('title',  __('staff/titles.customers_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-user"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.customers_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <h3 class="kt-section__title">{{ __('staff/forms.customers_general_details') }}</h3>
                <div class="kt-section__body">
                    <div class="form-group">
                        <label>{{ __('staff/forms.customers_title') }}</label>
                        <br>
                        {{ __('staff/forms.customers_title_'.$customer->title) }} 
                    </div>

                    <div class="form-group">
                        <label>{{ __('staff/forms.customers_first_name') }}</label>
                        <br>
                        {{ $customer->first_name }} 
                    </div>

                    <div class="form-group">
                        <label>{{ __('staff/forms.customers_middle_name') }}</label>
                        <br>
                        {{ $customer->middle_name }} 
                    </div>

                    <div class="form-group">
                        <label>{{ __('staff/forms.customers_last_name') }}</label>
                        <br>
                        {{ $customer->last_name }} 
                    </div>

                    <div class="form-group form-group-last">
                        <label>{{ __('staff/forms.customers_business_name') }}</label>
                        <br>
                        {{ $customer->business_name }} 
                    </div>

                </div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.customers.partials.sections.show.contact-details')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.customers.partials.sections.show.billing-details')
            
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/customers/view.js') }}" type="text/javascript"></script>
@endsection

