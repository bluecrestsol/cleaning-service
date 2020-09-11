@extends('layouts.admin.index')
@section('title', isset($agent) ? __('staff/titles.agents_edit') : __('staff/titles.agents_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-user-ninja"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($agent) ? __('staff/titles.agents_edit') : __('staff/titles.agents_create') }}
                </h3>
            </div>
        </div>

        @if (isset($agent))
            {!! Form::open(['route' => ['admin.agents.update', $agent->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.agents.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.agents.partials.form')

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
    <script src="{{ url('js/admin/agents/crud.js') }}" type="text/javascript"></script>
@stop