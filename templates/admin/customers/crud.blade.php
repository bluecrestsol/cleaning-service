@extends('layouts.admin.index')
@section('title', isset($customer) ? __('staff/titles.customers_edit') : __('staff/titles.customers_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-user"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($customer) ? __('staff/titles.customers_edit') : __('staff/titles.customers_create') }}
                </h3>
            </div>
        </div>

        @if (isset($customer))
            {!! Form::open(['route' => ['admin.customers.update', $customer->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.customers.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.customers.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_css_plugin')
    <link href="{{ url('assets/admin/vendors/general/intl-tel-input/css/intlTelInput.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/admin/vendors/general/intl-tel-input/css/isValidNumber.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_plugin')
    <script src="{{ url('assets/admin/vendors/general/intl-tel-input/js/intlTelInput.js') }}"></script>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/customers/crud.js') }}" type="text/javascript"></script>
@stop