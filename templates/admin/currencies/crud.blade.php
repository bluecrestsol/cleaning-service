@extends('layouts.admin.index')
@section('title', isset($currency) ? __('staff/titles.currencies_edit') : __('staff/titles.currencies_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-coins"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($currency) ? __('staff/titles.currencies_edit') : __('staff/titles.currencies_create') }}
                </h3>
            </div>
        </div>

        @if (isset($currency))
            {!! Form::open(['route' => ['admin.currencies.update', $currency->id], 
                'method' => 'PUT',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.currencies.store', 
                'method' => 'POST',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.currencies.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/currencies/crud.js') }}" type="text/javascript"></script>
@endsection