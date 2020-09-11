@extends('layouts.admin.index')
@section('title', __('staff/titles.customers') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-user"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.customers') }}
            </h3>
        </div>
        @if ($admin->can('customers-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.customers.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.customers_create') }}
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
                        <th>{{ __('staff/tables.customers_code') }}</th>
                        <th>{{ __('staff/tables.customers_name') }}</th>
                        <th>{{ __('staff/tables.customers_business_name') }}</th>
                        <th>{{ __('staff/tables.customers_country') }}</th>
                        <th>{{ __('staff/tables.customers_places') }}</th>
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
    <script src="{{ url('js/admin/customers/index.js') }}" type="text/javascript"></script>
@endsection
