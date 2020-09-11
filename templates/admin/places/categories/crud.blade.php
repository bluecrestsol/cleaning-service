@extends('layouts.admin.index')
@section('title', isset($placesCategory) ? __('staff/titles.places_categories_edit') : __('staff/titles.places_categories_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-map-marker"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($placesCategory) ? __('staff/titles.places_categories_edit') : __('staff/titles.places_categories_create') }}
                </h3>
            </div>
        </div>

        @if (isset($placesCategory))
            {!! Form::open(['route' => ['admin.places.categories.update', $placesCategory->id], 
                'method' => 'PUT',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @else
            {!! Form::open(['route' => 'admin.places.categories.store', 
                'method' => 'POST',
                'class' => 'form-horizontal', 'files' => true]) !!}
        @endif

        @include ('admin.places.categories.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/places/categories/crud.js') }}" type="text/javascript"></script>
@endsection