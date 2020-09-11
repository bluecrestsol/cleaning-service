@extends('layouts.admin.index')
@section('title', isset($district) ? __('staff/titles.districts_edit') : __('staff/titles.districts_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($district) ? __('staff/titles.districts_edit') : __('staff/titles.districts_create') }}
                </h3>
            </div>
        </div>

        @if (isset($district))
            {!! Form::open(['route' => ['admin.districts.update', $district->id], 
                'method' => 'PUT',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.districts.store', 
                'method' => 'POST',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.districts.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/districts/crud.js') }}" type="text/javascript"></script>
@stop