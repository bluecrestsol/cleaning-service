@extends('layouts.admin.index')
@section('title', __('staff/titles.appointments') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-calendar-check"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.appointments') }}
            </h3>
        </div>
        @if ($admin->can('appointments-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.appointments.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.appointments_create') }}
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
                "place" => $place,
                "crewMember" => $crewMember
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
                        <th>{{ __('staff/tables.appointments_code') }}</th>
                        <th>{{ __('staff/tables.appointments_place_name') }}</th>
                        <th>{{ __('staff/tables.appointments_place_category') }}</th>
                        <th>{{ __('staff/tables.appointments_location') }}</th>
                        <th>{{ __('staff/tables.appointments_area') }}</th>
                        <th>{{ __('staff/tables.appointments_crew_leader') }}</th>
                        <th>{{ __('staff/tables.appointments_crew') }}</th>
                        <th>{{ __('staff/tables.appointments_scheduled_at') }}</th>
                        <th>{{ __('staff/tables.appointments_serviced_at') }}</th>
                        <th>{{ __('staff/tables.appointments_status') }}</th>
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
    <script src="{{ url('js/admin/appointments/index.js') }}" type="text/javascript"></script>
@endsection
