@extends('layouts.admin.index')
@section('title', isset($appointment) ? __('staff/titles.appointments_edit') : __('staff/titles.appointments_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-calendar-check"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($appointment) ? __('staff/titles.appointments_edit') : __('staff/titles.appointments_create') }}
                </h3>
            </div>
        </div>

        @if (isset($appointment))
            {!! Form::open(['route' => ['admin.appointments.update', $appointment->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.appointments.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.appointments.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/appointments/crud.js') }}" type="text/javascript"></script>
@stop