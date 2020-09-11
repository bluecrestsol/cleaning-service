@extends('layouts.admin.index')
@section('title',  __('staff/titles.places_categories_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-map-marker"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.places_categories_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.places_categories_type') }}</label>
                <br />
                {{ !empty($placesCategory->type) ? __('staff/forms.places_categories_type_'.$placesCategory->type) : '' }}
            </div>

            @foreach ($languages as $language)
                <div class="form-group {{ $loop->last ? 'form-group-last' : '' }}">
                    <label>{{ __('staff/forms.places_categories_name') }} ({{ $language->english_name }})</label>
                    <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                        {{ __('staff/forms.places_categories_language_status_'.$language->status_public) }}
                    </span>
                    <br>
                    {{  $placesCategory->getTranslation('name', $language->code, false) }}
                </div>
            @endforeach

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.places.categories.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/places/categories/view.js') }}" type="text/javascript"></script>
@endsection

