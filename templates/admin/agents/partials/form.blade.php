<div class="kt-portlet__body">
    <collection
        variables='<?php echo json_encode([
            "old" => getOr(session()->getOldInput()),
            "agent" => $agent ?? null,
            "error" => $errors->messages()
        ]); ?>'>
    </collection>
    <div class="kt-section kt-section--first">
        <h3 class="kt-section__title">{{ __('staff/forms.agents_general_details') }}</h3>
        <div class="kt-section__body">
            <div class="form-group">
                <label>{{ __('staff/forms.agents_title') }}</label>
                <div class="group-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
                    <select name="title" class="form-control kt-selectpicker {{ $errors->has('title') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.agents_select_title') }}</option>
                        @foreach(['mr', 'mrs', 'ms', 'dr', 'prof'] as $title)
                            <option value="{{ $title }}"
                                {{ old('title', $agent->title ?? '') == $title ? 'selected' : '' }}>{{ __('staff/forms.agents_title_'.$title) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_first_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" value="{{ old('first_name', $agent->first_name ?? '') }}">
                {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_middle_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : ''}}" name="middle_name" value="{{ old('middle_name', $agent->middle_name ?? '') }}">
                {!! $errors->first('middle_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_last_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ old('last_name', $agent->last_name ?? '') }}">
                {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_gender') }}</label>
                <div class="group-control {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                    <select name="gender" class="form-control kt-selectpicker {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.agents_select_gender') }}</option>
                        @foreach(['male', 'female'] as $gender)
                            <option value="{{ $gender }}"
                                {{ old('gender', $agent->gender ?? '') == $gender ? 'selected' : '' }}>{{ __('staff/forms.agents_gender_'.$gender) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_date_of_birth') }}</label>
                <datepicker
                    name="date_of_birth"
                    initial="{{ old('date_of_birth', (isset($agent) && !empty($agent->date_of_birth) ? $agent->date_of_birth->format('m/d/Y') : '')) }}"
                    v-model="dateOfBirth.value"
                    :config= "dateOfBirth.config"
                    initial-error="{{ $errors->first('date_of_birth') }}"
                    :error.sync="dateOfBirth.error"
                ></datepicker>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_doc_type') }}</label>
                <div class="group-control {{ $errors->has('doc_type') ? 'is-invalid' : ''}}">
                    <select name="doc_type" class="form-control kt-selectpicker {{ $errors->has('doc_type') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.agents_select_doc_type') }}</option>
                        @foreach(['passport', 'id_card', 'drivers_license'] as $doc_type)
                            <option value="{{ $doc_type }}"
                                {{ old('doc_type', $agent->doc_type ?? '') == $doc_type ? 'selected' : '' }}>{{ __('staff/forms.agents_doc_type_'.$doc_type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('doc_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- nationality country --}}
            <div class="form-group">
                <label>{{ __('staff/forms.agents_nationality_country') }}</label>
                <select2
                    name="nationality_country_id"
                    initial="{{ old('nationality_country_id', $agent->nationality_country_id ?? '') }}"
                    v-model="nationalityCountry.value"
                    :options.sync="nationalityCountry.options"
                    placeholder="{{ __('staff/forms.agents_select_nationality_country') }}"
                    error="{{ $errors->first('nationality_country_id') }}"
                ></select2>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_type') }}</label>
                <div class="group-control {{ $errors->has('type') ? 'is-invalid' : ''}}">
                    <select name="type" class="form-control kt-selectpicker {{ $errors->has('type') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.agents_select_type') }}</option>
                        @foreach(['hired', 'freelancer'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $agent->type ?? '') == $type ? 'selected' : '' }}>{{ __('staff/forms.agents_type_'.$type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.agents_commission_rate') }}</label>
                <input type="text" class="form-control {{ $errors->has('commission_rate') ? 'is-invalid' : ''}}" name="commission_rate" value="{{ old('commission_rate', $agent->commission_rate ?? '') }}">
                {!! $errors->first('commission_rate', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.agents_status') }}</label>
                <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
                    <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.agents_select_status') }}</option>
                        @foreach(['enabled', 'disabled', 'dismissed'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $agent->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.agents_status_'.$status) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.agents.partials.sections.crud.contact-details')

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.agents.partials.sections.crud.spoken-languages')

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.agents.partials.sections.crud.uploads')
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.agents.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>