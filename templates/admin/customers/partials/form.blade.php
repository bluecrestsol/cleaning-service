<div class="kt-portlet__body">
    <div class="kt-section kt-section--first">
        <h3 class="kt-section__title">{{ __('staff/forms.customers_general_details') }}</h3>
        <div class="kt-section__body">
            <div class="form-group">
                <label>{{ __('staff/forms.customers_title') }} *</label>
                <div class="group-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
                    <select name="title" class="form-control kt-selectpicker {{ $errors->has('title') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.customers_select_title') }}</option>
                        @foreach(['mr', 'mrs', 'ms', 'dr', 'prof'] as $title)
                            <option value="{{ $title }}"
                                {{ old('title', $customer->title ?? '') == $title ? 'selected' : '' }}>{{ __('staff/forms.customers_title_'.$title) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.customers_first_name') }} *</label>
                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" value="{{ old('first_name', $customer->first_name ?? '') }}">
                {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.customers_middle_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : ''}}" name="middle_name" value="{{ old('middle_name', $customer->middle_name ?? '') }}">
                {!! $errors->first('middle_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.customers_last_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ old('last_name', $customer->last_name ?? '') }}">
                {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.customers_business_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('business_name') ? 'is-invalid' : ''}}" name="business_name" value="{{ old('business_name', $customer->business_name ?? '') }}">
                {!! $errors->first('business_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.customers.partials.sections.crud.contact-details')

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.customers.partials.sections.crud.billing-details')

</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.customers.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>