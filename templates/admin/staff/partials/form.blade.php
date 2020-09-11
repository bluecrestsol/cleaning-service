<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.staff_first_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" value="{{ old('first_name', $staff->first_name ?? '') }}" >
        {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.staff_last_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ old('last_name', $staff->last_name ?? '') }}" >
        {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.staff_email') }}</label>
        <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $staff->email ?? '') }}" >
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.staff_password') }}</label>
        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" value="">
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.staff_role') }}</label>
        <div class="group-control {{ $errors->has('role') ? 'is-invalid' : ''}}">
            <select name="role" class="form-control kt-selectpicker {{ $errors->has('role') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.staff_select_role') }}</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('role', (isset($staff) && $staff->roles()->first()->id ?? '')) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.staff_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.staff_select_status') }}</option>
                @foreach(['enabled', 'disabled'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $staff->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.staff_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.staff.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>