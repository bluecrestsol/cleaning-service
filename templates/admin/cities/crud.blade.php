@extends('layouts.admin.index')
@section('title', isset($city) ? __('staff/titles.cities_edit') : __('staff/titles.cities_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($city) ? __('staff/titles.cities_edit') : __('staff/titles.cities_create') }}
                </h3>
            </div>
        </div>

        @if (isset($city))
            {!! Form::open(['route' => ['admin.cities.update', $city->id], 
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.cities.store', 
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.cities.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/cities/crud.js') }}" type="text/javascript"></script>
@stop