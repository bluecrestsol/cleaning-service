@extends('layouts.admin.index')
@section('title', isset($contract) ? __('staff/titles.contracts_edit') : __('staff/titles.contracts_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-file-contract"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($contract) ? __('staff/titles.contracts_edit') : __('staff/titles.contracts_create') }}
                </h3>
            </div>
        </div>

        @if (isset($contract))
            {!! Form::open(['route' => ['admin.contracts.update', $contract->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.contracts.store', 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.contracts.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/contracts/crud.js') }}" type="text/javascript"></script>
@stop