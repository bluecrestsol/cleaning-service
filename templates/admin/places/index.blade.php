@extends('layouts.admin.index')
@section('title', __('staff/titles.places') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-map-marker"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.places') }}
            </h3>
        </div>
        @if ($admin->can('places-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.places.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.places_create') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="kt-portlet__body">

        @include('admin.partials.pre_data')
        <collection
            variables='<?php echo json_encode([
                "customer" => $customer,
                "agent" => $agent
            ]); ?>'>
        </collection>
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
                        <th>{{ __('staff/tables.places_code') }}</th>
                        <th>{{ __('staff/tables.places_name') }}</th>
                        <th>{{ __('staff/tables.places_type') }}</th>
                        <th>{{ __('staff/tables.places_category') }}</th>
                        <th>{{ __('staff/tables.places_area') }} {{ (isset($admin->active_country) && !empty($admin->active_country->area_unit)) ? ('('.__('staff/tables.places_area_unit_'.$admin->active_country->area_unit).')') : '' }}</th>
                        <th>{{ __('staff/tables.places_state') }}</th>
                        <th>{{ __('staff/tables.places_city') }}</th>
                        <th>{{ __('staff/tables.places_district') }}</th>
                        <th>{{ __('staff/tables.places_financial_type') }}</th>
                        <th>{{ __('staff/tables.places_customer') }}</th>
                        <th>{{ __('staff/tables.places_appointments') }}</th>
                        <th>{{ __('staff/tables.places_status') }}</th>
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
    <script src="{{ url('js/admin/places/index.js') }}" type="text/javascript"></script>
@endsection
