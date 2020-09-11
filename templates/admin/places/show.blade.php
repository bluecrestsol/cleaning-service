@extends('layouts.admin.index')
@section('title',  __('staff/titles.places_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-map-marker"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.places_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_code') }}</label>
                        <br>
                        {{ $place->code ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_financial_type') }}</label>
                        <br>
                        @if (!empty($place->financial_type))
                            <span class="kt-badge kt-badge--inline {{ $place->financial_type == 'billed' ? 'kt-badge--success' : 'kt-badge--warning' }}">{{ __('staff/forms.places_financial_type_'.$place->financial_type) }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_agent') }}</label>
                        <br>
                        {{ implodeNotNull(' ', [
                            ($place->agent->first_name ?? null),
                            ($place->agent->middle_name ?? null),
                            ($place->agent->last_name ?? null)
                        ]) }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_customer') }}</label>
                        <br>
                        {{ implodeNotNull(' ', [
                            ($place->customer->first_name ?? null),
                            ($place->customer->middle_name ?? null),
                            ($place->customer->last_name ?? null)
                        ]) }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_name') }}</label>
                        <br>
                        {{ $place->name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_type') }}</label>
                        <br>
                        {{ isset($place->category) && !empty($place->category->type) ? __('staff/forms.places_type_'.$place->category->type) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_category') }}</label>
                        <br>
                        {{ $place->category->name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_status') }}</label>
                        <br>
                        <span class="kt-badge kt-badge--inline {{ $place->status == 'enabled' ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.places_status_'.$place->status) }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_area') }} {{ isset($country->area_unit) ? '('.$country->area_unit.')' : '' }}</label>
                        <br>
                        {{ $place->area }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_state') }}</label>
                        <br>
                        {{ $place->state->name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_city') }}</label>
                        <br>
                        {{ $place->city->name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_district') }}</label>
                        <br>
                        {{ $place->district->name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_public_listing') }}</label>
                        <br>
                        <span class="kt-badge kt-badge--inline {{ (isset($place->is_listing_public) && $place->is_listing_public == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.places_public_listing_'.(isset($place->is_listing_public) && $place->is_listing_public == '1' ? 'yes' : 'no')) }}</span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.places_public_history') }}</label>
                        <br>
                        <span class="kt-badge kt-badge--inline {{ (isset($place->is_history_public) && $place->is_history_public == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.places_public_history_'.(isset($place->is_history_public) && $place->is_history_public == '1' ? 'yes' : 'no')) }}</span>
                    </div>
                    <div class="form-group form-group-last">
                        <label>{{ __('staff/forms.places_public_photos') }}</label>
                        <br>
                        <span class="kt-badge kt-badge--inline {{ (isset($place->is_gallery_public) && $place->is_gallery_public == '1') ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.places_public_photos_'.(isset($place->is_gallery_public) && $place->is_gallery_public == '1' ? 'yes' : 'no')) }}</span>
                    </div>
                </div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.places.partials.sections.show.address')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.places.partials.sections.show.billing-details')

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.places.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/places/view.js') }}" type="text/javascript"></script>
@endsection