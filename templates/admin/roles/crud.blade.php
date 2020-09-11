@extends('layouts.admin.index')
@section('title', isset($role) ? __('staff/titles.roles_edit') : __('staff/titles.roles_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-user-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($role) ? __('staff/titles.roles_edit') : __('staff/titles.roles_create') }}
                </h3>
            </div>
        </div>

        @if (isset($role))
            {!! Form::open(['route' => ['admin.roles.update', $role->id], 
                'method' => 'PUT',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.roles.store', 
                'method' => 'POST',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.roles.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/roles/crud.js') }}" type="text/javascript"></script>
@stop