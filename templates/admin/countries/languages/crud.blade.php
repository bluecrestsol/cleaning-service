@extends('layouts.admin.index')
@section('title', isset($language) ? __('staff/titles.countries_languages_edit') : __('staff/titles.countries_languages_add'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-language"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($language) ? __('staff/titles.countries_languages_edit_page') .' '. $country->name
                        : __('staff/titles.countries_languages_add_page') .' '. $country->name }}
                </h3>
            </div>
        </div>
        
        @if (isset($language))
            {!! Form::open(['route' => ['admin.countries.languages.update', $country->id, $language->id], 
                'method' => 'PUT',
                'id' => 'form-crud',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => ['admin.countries.languages.store', $country->id], 
                'method' => 'POST',
                'id' => 'form-crud',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.countries.languages.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/countries/languages/crud.js') }}" type="text/javascript"></script>
@stop