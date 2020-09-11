{{-- Send data to layout defining the current page and data  --}}
@extends('layouts.admin.index', ['page' => 'contact-requests/crud', 'data' => []])
@section('title', isset($contract) ? __('staff/titles.contact_requests_edit') : __('staff/titles.contact_requests_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-file-contract"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($contact) ? __('staff/titles.contact_requests_edit') : __('staff/titles.contact_requests_create') }}
                </h3>
            </div>
        </div>

        @if (isset($contact))
            {!! Form::open(['route' => ['admin.contact_requests.update', $contact->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.contact_requests.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.contact-requests.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/app.js') }}" type="text/javascript"></script>
@stop