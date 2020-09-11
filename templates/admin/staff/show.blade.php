@extends('layouts.admin.index')
@section('title',  __('staff/titles.staff_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-user-tie"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.staff_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.staff_first_name') }}</label>
                <br />
                {{ $staff->first_name }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.staff_last_name') }}</label>
                <br />
                {{ $staff->last_name }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.staff_email') }}</label>
                <br />
                {{ $staff->email }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.staff_role') }}</label>
                <br />
                {{ $staff->roles()->first()->name }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.staff_status') }}</label>
                <br />
                <span class="kt-badge kt-badge--{{ ($staff->status == 'enabled') ? 'success' : 'danger' }} kt-badge--inline">
                    {{ __('staff/forms.staff_status_'.$staff->status) }}
                </span>
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.staff.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/staff/view.js') }}" type="text/javascript"></script>
@endsection