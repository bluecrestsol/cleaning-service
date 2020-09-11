

<div class="kt-portlet__body">
    <collection
        variables='<?php echo json_encode([
            "country" => $country,
            "language" => $language ?? null
        ]); ?>'>
    </collection>
    <div class="form-group">
        <label>{{ __('staff/forms.countries_languages_language') }}</label> <i class="fa fa-spinner fa-spin" v-if="language.loading" style="margin-left: 5px;"></i>
        <select2
            name="language_id"
            initial="{{ old('language_id', $language->id ?? '') }}"
            v-model="language.value"
            :options.sync="language.options"
            placeholder="{{ __('staff/forms.countries_languages_select_language') }}"
            error="{{ $errors->first('language_id') }}"
        ></select2>
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_languages_status')}}</label>
        <v-switch
            name="status"
            initial="{{ old('status', $language->pivot->status ?? '') }}"
            :options="status.options"
            v-model="status.value"
        ></v-switch>
    </div>

    <div class="form-group">
        <label>{{__('staff/forms.countries_languages_is_primary')}}</label>
        <v-switch
            name="is_primary"
            initial="{{ old('is_primary', $language->pivot->is_primary ?? '') }}"
            :options="isPrimary.options"
            v-model="isPrimary.value"
        ></v-switch>
    </div>
</div>  
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.countries.languages.index', $country->id) }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>