@extends('layouts.admin.index')
@section('title',  __('staff/titles.contracts_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-file-contract"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.contracts_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_customer_code') }}</label>
                <br>
                {{ $contract->customer->code ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_customer_title') }}</label>
                <br>
                {{ __('staff/forms.contracts_customer_title_'.($contract->customer->title ?? '')) }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_customer_first_name') }}</label>
                <br>
                {{ $contract->customer->first_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_customer_last_name') }}</label>
                <br>
                {{ $contract->customer->last_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_customer_business_name') }}</label>
                <br>
                {{ $contract->customer->business_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_place') }}</label>
                <br>
                {{ $contract->place->name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_frequency') }}</label>
                <br>
                {{ isset($contract->frequency) ? __('staff/forms.contracts_frequency_'.$contract->frequency) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_price_unit') }}</label>
                <br>
                {{ isset($contract->price_unit) ? __('staff/forms.contracts_price_unit_'.$contract->price_unit) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_price') }}</label>
                <br>
                {{ isset($contract->price) ? decimal(number_format($contract->price, 2)) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_starts_at') }}</label>
                <br>
                {{ optional($contract->started_at)->format('F d, Y') }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contracts_ends_at') }}</label>
                <br>
                {{ optional($contract->ended_at)->format('F d, Y') }} 
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.contracts.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/contracts/view.js') }}" type="text/javascript"></script>
@endsection

