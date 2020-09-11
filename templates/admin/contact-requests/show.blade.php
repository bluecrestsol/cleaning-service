{{-- Send data to layout defining the current page and data  --}}
@extends('layouts.admin.index', ['page' => 'contact-requests/view', 'data' => []])
@section('title',  __('staff/titles.contact_requests_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-envelope"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.contact_requests_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_created_at') }}</label>
                <br />
                {{ !empty($contact->created_at) ? $contact->created_at->format('F d, Y H:i:s') : '' }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_status') }}</label>
                <br />
                <span class="kt-badge kt-badge--{{ ($contact->status == 'new') ? 'warning' : 'success' }} kt-badge--inline">
                    {{ __('staff/forms.contact_requests_status_'.$contact->status) }}
                </span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_name') }}</label>
                <br />
                {{ $contact->name }}
            </div>
        
            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_business_name') }}</label>
                <br />
                {{ $contact->business_name }}
            </div>
        
            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_email') }}</label>
                <br />
                {{ $contact->email }}
            </div>
            
            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_phone') }}</label>
                <br />
                {{ $contact->phone }}
            </div>
        
            <div class="form-group">
                <label>{{ __('staff/forms.contact_requests_message') }}</label>
                <br />
                {{ $contact->message }}
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.contact_requests.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/app.js') }}" type="text/javascript"></script>
@endsection