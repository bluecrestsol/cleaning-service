@extends('layouts.admin.index')
@section('title', __('staff/titles.contracts') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-file-contract"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.contracts') }}
            </h3>
        </div>
        @if ($admin->can('contracts-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.contracts.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.contracts_create') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="kt-portlet__body">

        @include('admin.partials.pre_data')
        
        <datatable
            v-if="config"
            id="kt_table_1"
            :options="config.options"
            :url="config.url"
            :notifications="config.notifications"
        >
            <template>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('staff/tables.contracts_code') }}</th>
                        <th>{{ __('staff/tables.contracts_customer') }}</th>
                        <th>{{ __('staff/tables.contracts_place') }}</th>
                        <th>{{ __('staff/tables.contracts_start_date') }}</th>
                        <th>{{ __('staff/tables.contracts_end_date') }}</th>
                        <th>{{ __('staff/tables.contracts_frequency') }}</th>
                        <th>{{ __('staff/tables.contracts_price') }}</th>
                        <th>{{ __('staff/tables.actions') }}</th>
                    </tr>
                </thead>
            </template>
        </datatable>
    </div>
</div>
@stop


@section('page_css_plugin')
<link href="{{ url('assets/admin/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_plugin')
    <script src="{{ url('assets/admin/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
@stop

@section('page_script')
    <script src="{{ url('js/admin/contracts/index.js') }}" type="text/javascript"></script>
@endsection
