<div class="kt-section kt-section--last">
    <h3 class="kt-section__title">{{ __('staff/forms.crew_members_spoken_languages') }}</h3>
    <div class="kt-section__body">
        <div class="form-group form-group-last">
            <select2
                name="languages[]"
                :multiple="true"
                v-model="language.selected"
                :options.sync="language.list"
                placeholder="{{ __('staff/forms.crew_members_select_spoken_languages') }}"
                error="{{ $errors->first('languages.*') }}"
            ></select2>
        </div>
    </div>
</div>