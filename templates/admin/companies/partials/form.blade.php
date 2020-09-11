<div class="kt-portlet__body">
    <div class="kt-section kt-section--first">
        {{-- section title --}}
        <h3 class="kt-section__title">{{ __('staff/forms.companies_general_details') }}</h3>
        {{-- section body --}}
        <div class="kt-section__body">
            {{-- name --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $company->name ?? '') }}">
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- country --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_country') }} *</label> <i class="fa fa-spinner fa-spin" v-if="country.loading" style="margin-left: 5px;"></i>
                <select2
                    name="country_id"
                    initial="{{ old('country_id', $company->country_id ?? $admin->active_country_id) }}"
                    v-model="country.value"
                    :options.sync="country.options"
                    placeholder="{{ __('staff/forms.companies_select_country') }}"
                    error="{{ $errors->first('country_id') }}"
                ></select2>
            </div>

            {{-- registration number --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_registration_number') }}</label>
                <input type="text" class="form-control {{ $errors->has('reg_number') ? 'is-invalid' : ''}}" name="reg_number" value="{{ old('reg_number', $company->reg_number ?? '') }}">
                {!! $errors->first('reg_number', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- website --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_website') }}</label>
                <input type="text" class="form-control {{ $errors->has('website') ? 'is-invalid' : ''}}" name="website" value="{{ old('website', $company->website ?? '') }}">
                {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- facebook --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_facebook') }}</label>
                <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : ''}}" name="facebook" value="{{ old('facebook', $company->facebook ?? '') }}">
                {!! $errors->first('facebook', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- instagram --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_instagram') }}</label>
                <input type="text" class="form-control {{ $errors->has('instagram') ? 'is-invalid' : ''}}" name="instagram" value="{{ old('instagram', $company->instagram ?? '') }}">
                {!! $errors->first('instagram', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- youtube --}}
            <div class="form-group">
                <label>{{ __('staff/forms.companies_youtube') }}</label>
                <input type="text" class="form-control {{ $errors->has('youtube') ? 'is-invalid' : ''}}" name="youtube" value="{{ old('youtube', $company->youtube ?? '') }}">
                {!! $errors->first('youtube', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- linked in --}}
            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.companies_linkedin') }}</label>
                <input type="text" class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : ''}}" name="linkedin" value="{{ old('linkedin', $company->linkedin ?? '') }}">
                {!! $errors->first('linkedin', '<div class="invalid-feedback">:message</div>') !!}
            </div>
           
        </div>
    </div>

    {{-- contact details related fields section --}}
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.companies.partials.sections.crud.contact-details')

    {{-- address related fields section --}}
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.companies.partials.sections.crud.address')

    {{-- billing details related fields section --}}
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.companies.partials.sections.crud.billing-details')

</div>

{{-- form footer --}}
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.companies.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>