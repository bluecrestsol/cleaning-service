@extends('layouts.admin.index')
@section('title',  __('staff/titles.currencies_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-coins"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.currencies_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.currencies_code') }}</label>
                <br>
                {{ $currency->code }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.currencies_name') }}</label>
                <br>
                {{ $currency->name }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.currencies_symbol') }}</label>
                <br>
                {{ $currency->symbol }} 
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.currencies.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/currencies/view.js') }}" type="text/javascript"></script>
@endsection

