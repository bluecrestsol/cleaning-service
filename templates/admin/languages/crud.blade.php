@extends('layouts.admin.index')
@section('title', isset($language) ? __('staff/titles.languages_edit') : __('staff/titles.languages_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-question-circle"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($language) ? __('staff/titles.languages_edit') : __('staff/titles.languages_create') }}
                </h3>
            </div>
        </div>

        @if (isset($language))
            {!! Form::open(['route' => ['admin.languages.update', $language->id], 
                'method' => 'PUT',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.languages.store', 
                'method' => 'POST',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.languages.partials.form')

        {!! Form::close() !!}
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/languages/crud.js') }}" type="text/javascript"></script>
@stop