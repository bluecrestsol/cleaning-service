@extends('layouts.admin.index')
@section('title',  __('staff/titles.languages_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-question-circle"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.languages_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.languages_code') }}</label>
                <br>
                {{ $language->code }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.languages_english_name') }}</label>
                <br>
                {{ $language->english_name }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.languages_name') }}</label>
                <br>
                {{ $language->name }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.languages_status_public') }}</label>
                <br />
                @if (isset($language->status_public))
                    <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                        {{ __('staff/forms.languages_status_'.$language->status_public) }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.languages_status_staff') }}</label>
                <br />
                @if (isset($language->status_staff))
                    <span class="kt-badge kt-badge--{{ ($language->status_staff == 'enabled') ? 'success' : 'danger' }} kt-badge--inline">
                        {{ __('staff/forms.languages_status_'.$language->status_staff) }}
                    </span>
                @endif
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/languages/view.js') }}" type="text/javascript"></script>
@endsection