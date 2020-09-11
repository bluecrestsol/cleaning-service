@extends('layouts.admin.index')
@section('title', isset($service) ? __('staff/titles.services_edit') : __('staff/titles.services_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-spray-can"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($service) ? __('staff/titles.services_edit') : __('staff/titles.services_create') }}
                </h3>
            </div>
        </div>

        @if (isset($service))
            {!! Form::open(['route' => ['admin.services.update', $service->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.services.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.services.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/services/crud.js') }}" type="text/javascript"></script>
@stop