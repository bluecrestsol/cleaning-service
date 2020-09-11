@extends('layouts.admin.index')
@section('title', __('staff/titles.services'))

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-spray-can"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.services') }}
            </h3>
        </div>
        {{-- check if user can create services --}}
        @if ($admin->can('services-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.services_create') }}
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="kt-portlet__body">

        {{-- include extra data for datatable --}}
        @include('admin.partials.pre_data')
        
        {{-- datatable --}}
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
                        <th>{{ __('staff/tables.services_order') }}</th>
                        <th>{{ __('staff/tables.services_type') }}</th>
                        <th>{{ __('staff/tables.services_name') }}</th>
                        <th>{{ __('staff/tables.services_price') }}</th>
                        <th>{{ __('staff/tables.services_discounted_price') }}</th>
                        <th>{{ __('staff/tables.services_status') }}</th>
                        <th>{{ __('staff/tables.actions') }}</th>
                    </tr>
                </thead>
            </template>
        </datatable>
    </div>
</div>
@stop

{{-- css plugins --}}
@section('page_css_plugin')
<link href="{{ url('assets/admin/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- page plugin scripts --}}
@section('page_plugin')
    <script src="{{ url('assets/admin/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
@stop

{{-- page scripts --}}
@section('page_script')
    <script src="{{ url('js/admin/services/index.js') }}" type="text/javascript"></script>
@endsection
