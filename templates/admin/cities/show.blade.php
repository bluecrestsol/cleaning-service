@extends('layouts.admin.index')
@section('title', __('staff/titles.cities_view') )

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-globe"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('staff/titles.cities_view') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="form-group">
                <label>{{ __('staff/forms.cities_country') }}</label>
                <br>
                {{ $city->country->name ?? '' }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.cities_state') }}</label>
                <br>
                {{ $city->state->name ?? '' }}
            </div>

            @foreach ($languages as $language)
                <div class="form-group {{ $loop->last ? 'form-group-last' : '' }}">
                    <label>{{ __('staff/forms.cities_name') }} ({{ $language->english_name }})</label>
                    <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                        {{ __('staff/forms.cities_language_status_'.$language->status_public) }}
                    </span>
                    <br>
                    {{  $city->getTranslation('name', $language->code, false) }}
                </div>
            @endforeach
        </div> 
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.cities.index') }}" title="Back" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div>       
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/cities/view.js') }}" type="text/javascript"></script>
@endsection

