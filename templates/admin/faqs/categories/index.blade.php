@extends('layouts.admin.index')
@section('title', __('staff/titles.faqs_categories') )

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fas fa-question-circle"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{ __('staff/titles.faqs_categories') }}
            </h3>
        </div>
        @if ($admin->can('faqs-categories-create'))
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <a href="{{ route('admin.faqs_categories.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            {{  __('staff/buttons.faqs_categories_create') }}
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
                        <th>{{ __('staff/tables.faqs_categories_order') }}</th>
                        <th>{{ __('staff/tables.faqs_categories_name') }}</th>
                        <th>{{ __('staff/tables.faqs_categories_questions') }}</th>
                        <th>{{ __('staff/tables.faqs_categories_translations') }}</th>
                        <th>{{ __('staff/tables.faqs_categories_status') }}</th>
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
    <script src="{{ url('js/admin/faqs/categories/index.js') }}" type="text/javascript"></script>
@endsection
