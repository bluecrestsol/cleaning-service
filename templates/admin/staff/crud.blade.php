@extends('layouts.admin.index')
@section('title', isset($staff) ? __('staff/titles.staff_edit') : __('staff/titles.staff_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-user-tie"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{ isset($staff) ? __('staff/titles.staff_edit') : __('staff/titles.staff_create') }}
                </h3>
            </div>
        </div>

        @if (isset($staff))
            {!! Form::open(['route' => ['admin.staff.update', $staff->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.staff.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.staff.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/staff/crud.js') }}" type="text/javascript"></script>
@stop