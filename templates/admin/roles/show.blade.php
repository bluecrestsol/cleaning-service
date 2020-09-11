@extends('layouts.admin.index')
@section('title', __('staff/titles.roles_view'))

@section("page_css")
    <style>
        label {
            font-weight: bold;
        }
    </style>
@endsection

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-user-tag"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ __('staff/titles.roles_view') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="form-group">
                <label>{{ __('staff/forms.roles_name') }}</label>
                <br>
                {{ $role->name }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.roles_permissions') }}</label>
                <br />
                @foreach($role->permissions as $permission)
                    <label class="label label-success">{{ $permission->name }}</label>
                    <br />
                @endforeach
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{!! route('admin.roles.index') !!}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div>       
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/roles/view.js') }}" type="text/javascript"></script>
@endsection