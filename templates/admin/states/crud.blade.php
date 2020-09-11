@extends('layouts.admin.index')
@section('title', isset($state) ? __('staff/titles.states_edit') : __('staff/titles.states_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet m-form m-form--state">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($state) ? __('staff/titles.states_edit') : __('staff/titles.states_create') }}
                </h3>
            </div>
        </div>

        @if (isset($state))
            {!! Form::open(['route' => ['admin.states.update', $state->id], 
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.states.store', 
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.states.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/states/crud.js') }}" type="text/javascript"></script>
@endsection