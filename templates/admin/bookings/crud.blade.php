@extends('layouts.admin.index')
@section('title', isset($booking) ? __('staff/titles.bookings_edit') : __('staff/titles.bookings_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-clipboard-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($booking) ? __('staff/titles.bookings_edit') : __('staff/titles.bookings_create') }}
                </h3>
            </div>
        </div>

        @if (isset($booking))
            {!! Form::open(['route' => ['admin.bookings.update', $booking->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.bookings.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.bookings.partials.form')

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
    <script src="{{ url('js/admin/bookings/crud.js') }}" type="text/javascript"></script>
@stop