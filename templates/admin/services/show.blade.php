@extends('layouts.admin.index')
@section('title',  __('staff/titles.services_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-spray-can"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.services_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            @foreach (['name', 'description', 'public_name'] as $field)
                @foreach ($languages as $language)
                    <div class="form-group">
                        <label>{{ __('staff/forms.services_'.$field) }} ({{ $language->english_name }})</label>
                        <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                            {{ __('staff/forms.services_language_status_'.$language->status_public) }}
                        </span>
                        <br>
                        {{  $service->getTranslation($field, $language->code, false) }}
                    </div>
                @endforeach
            @endforeach
            
            <div class="form-group">
                <label>{{ __('staff/forms.services_type') }}</label>
                <br />
                {{ !empty($service->type) ? __('staff/forms.services_type_'.$service->type) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.services_price') }}</label>
                <br />
                {{ !empty($service->price) ? decimal(number_format($service->price, 2)) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.services_discount_price') }}</label>
                <br />
                {{ !empty($service->discounted_price) ? decimal(number_format($service->discounted_price, 2)) : '' }} 
            </div>

            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.services_status') }}</label>
                <br>
                <span class="kt-badge kt-badge--inline {{ $service->status == 'enabled' ? 'kt-badge--success' : 'kt-badge--danger' }}">{{ __('staff/forms.services_status_'.$service->status) }}</span>
            </div>
           
        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/services/view.js') }}" type="text/javascript"></script>
@endsection

