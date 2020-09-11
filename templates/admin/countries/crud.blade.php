@extends('layouts.admin.index')
@section('title', isset($country) ? __('staff/titles.countries_edit') : __('staff/titles.countries_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($country) ? __('staff/titles.countries_edit') : __('staff/titles.countries_create') }}
                </h3>
            </div>
        </div>

        @if (isset($country))
            {!! Form::open(['route' => ['admin.countries.update', $country->id], 
                'method' => 'PUT',
                'id' => 'form-crud',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.countries.store', 
                'method' => 'POST',
                'id' => 'form-crud',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.countries.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/countries/crud.js') }}" type="text/javascript"></script>
@stop