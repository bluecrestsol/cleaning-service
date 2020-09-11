@extends('layouts.admin.index')
@section('title', isset($note) ? __('staff/titles.customers_notes_edit') : __('staff/titles.customers_notes_add'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-sticky-note"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($note) ? __('staff/titles.customers_notes_edit_page') . " {$customer->first_name} {$customer->last_name}"
                        : __('staff/titles.customers_notes_add_page') . " {$customer->first_name} {$customer->last_name}" }}
                </h3>
            </div>
        </div>

        @if (isset($note))
            {!! Form::open(['route' => ['admin.customers.notes.update', $customer->id, $note->id],
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => ['admin.customers.notes.store', $customer->id], 
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.customers.notes.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/customers/notes/crud.js') }}" type="text/javascript"></script>
@stop