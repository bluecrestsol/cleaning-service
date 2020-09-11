@extends('layouts.admin.index')
@section('title', __('staff/titles.bookings') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-clipboard-list"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.bookings') }}
            </h3>
        </div>
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
                        <th>{{ __('staff/tables.bookings_created_at') }}</th>
                        <th>{{ __('staff/tables.bookings_booked_at') }}</th>
                        <th>{{ __('staff/tables.bookings_name') }}</th>
                        <th>{{ __('staff/tables.bookings_business_name') }}</th>
                        <th>{{ __('staff/tables.bookings_services') }}</th>
                        <th>{{ __('staff/tables.bookings_status') }}</th>
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
    <script src="{{ url('js/admin/bookings/index.js') }}" type="text/javascript"></script>
@endsection
