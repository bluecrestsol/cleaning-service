<div class="kt-portlet__body">
    <div class="form-group">
        <label>{{ __('staff/forms.roles_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $role->name ?? '') }}" >
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.roles_permissions') }}</label>
        <br/>
        <table class="table table-stripped table-hover">
            @foreach($permissions as $permission)
                <tr>
                    <td>
                        @if( $permission->parent_id == 0)
                            <strong>{{ $permission->name }}</strong>
                        @else
                            __ {{ $permission->name }}
                        @endif
                    </td>
                    <td>
                        @if (!empty($permission->description))
                            <i class="fa fa-info" data-skin="dark" data-toggle="kt-tooltip" data-placement="top"
                                title="" data-original-title="{{ $permission->description }}"></i>
                        @endif
                    </td>
                    <td>
                        <label class="kt-checkbox kt-checkbox--tick kt-checkbox--success">
                            <input {{ old('permissions') ? (in_array($permission->name, old('permissions')) ? 'checked' : '')
                                : (isset($role) && $role->permissions->contains('id', $permission->id) ? 'checked' : '') }} type="checkbox"
                                data-parent="{{ $permission->parent_id }}" name="permissions[]" value="{{ $permission->name }}"
                                id="{{ $permission->id }}" class="styled pcheck">
                            <label class="" for="{{$permission->id}}"></label>
                                <span></span>
                            </label>
                        </label>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.roles.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>