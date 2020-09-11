<div class="kt-portlet__body">
    <collection
        variables='<?php echo json_encode([
            "old" => getOr(session()->getOldInput()),
            "booking" => $booking,
            "error" => $errors->messages()
        ]); ?>'>
    </collection>
    <div class="form-group">
        <label>{{ __('staff/forms.bookings_status') }}</label>
        <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
            <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                <option value="">{{ __('staff/forms.bookings_select_status') }}</option>
                @foreach(['new', 'processed', 'deleted'] as $status)
                    <option value="{{ $status }}"
                        {{ old('status', $booking->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.bookings_status_'.$status) }}</option>
                @endforeach
            </select>
        </div>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_booked_at') }}</label>
        <datetimepicker
            name="booked_at"
            initial="{{ old('booked_at', $booking->booked_at ?? '') }}"
            v-model="bookedAt.value"
            :error.sync="bookedAt.error"
        ></datetimepicker>
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $booking->name ?? '') }}">
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_business_name') }}</label>
        <input type="text" class="form-control {{ $errors->has('business_name') ? 'is-invalid' : ''}}" name="business_name" value="{{ old('business_name', $booking->business_name ?? '') }}">
        {!! $errors->first('business_name', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_email') }}</label>
        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $booking->email ?? '') }}">
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_phone') }}</label>
        <mobile :config="phone.config"
            initial="{{ old('phone', $booking->phone ?? '') }}"
            v-model="phone.value"
            :names="['phone_number', 'phone_country_code']"
            error="{{ $errors->first('phone') }}"
            @change="onPhoneChange">
        </mobile>
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_area') }}</label>
        <input type="text" class="form-control {{ $errors->has('area') ? 'is-invalid' : ''}}" name="area" value="{{ old('area', $booking->area ?? '') }}">
        {!! $errors->first('area', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_service') }}</label> <i class="fa fa-spinner fa-spin" v-if="service.loading" style="margin-left: 5px;"></i>

        <select2
            name="service_id"
            initial="{{ old('service_id', $booking->service_id ?? '') }}"
            v-model="service.value"
            :options.sync="service.options"
            placeholder="{{ __('staff/forms.bookings_select_service') }}"
            error="{{ $errors->first('service_id') }}"
        ></select2>
    </div>

    <div class="form-group">
        <label>{{ __('staff/forms.bookings_address') }}</label>
        <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : ''}}"
            name="address"
            rows="5">{{ old('address', $booking->address ?? '') }}</textarea>
        {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
    </div>

    <div class="form-group form-group-last">
        <label>{{ __('staff/forms.bookings_notes') }}</label>
        <textarea class="form-control {{ $errors->has('area') ? 'is-invalid' : ''}}"
            name="notes"
            rows="5">{{ old('notes', $booking->notes ?? '') }}</textarea>
        {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.bookings.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>
