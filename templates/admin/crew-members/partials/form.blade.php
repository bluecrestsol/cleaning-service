<div class="kt-portlet__body">
    <collection
        variables='<?php echo json_encode([
            "old" => getOr(session()->getOldInput()),
            "crewMember" => $crewMember ?? null,
            "error" => $errors->messages()
        ]); ?>'>
    </collection>
    <div class="kt-section kt-section--first">
        <h3 class="kt-section__title">{{ __('staff/forms.crew_members_general_details') }}</h3>
        <div class="kt-section__body">
            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_title') }}</label>
                <div class="group-control {{ $errors->has('title') ? 'is-invalid' : ''}}">
                    <select name="title" class="form-control kt-selectpicker {{ $errors->has('title') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.crew_members_select_title') }}</option>
                        @foreach(['mr', 'mrs', 'ms', 'dr', 'prof'] as $title)
                            <option value="{{ $title }}"
                                {{ old('title', $crewMember->title ?? '') == $title ? 'selected' : '' }}>{{ __('staff/forms.crew_members_title_'.$title) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_first_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : ''}}" name="first_name" value="{{ old('first_name', $crewMember->first_name ?? '') }}">
                {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_middle_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : ''}}" name="middle_name" value="{{ old('middle_name', $crewMember->middle_name ?? '') }}">
                {!! $errors->first('middle_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_last_name') }}</label>
                <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : ''}}" name="last_name" value="{{ old('last_name', $crewMember->last_name ?? '') }}">
                {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_gender') }}</label>
                <div class="group-control {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                    <select name="gender" class="form-control kt-selectpicker {{ $errors->has('gender') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.crew_members_select_gender') }}</option>
                        @foreach(['male', 'female'] as $gender)
                            <option value="{{ $gender }}"
                                {{ old('gender', $crewMember->gender ?? '') == $gender ? 'selected' : '' }}>{{ __('staff/forms.crew_members_gender_'.$gender) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_date_of_birth') }}</label>
                <datepicker
                    name="date_of_birth"
                    initial="{{ old('date_of_birth', (isset($crewMember) && !empty($crewMember->date_of_birth) ? $crewMember->date_of_birth->format('m/d/Y') : '')) }}"
                    v-model="dateOfBirth.value"
                    :config= "dateOfBirth.config"
                    initial-error="{{ $errors->first('date_of_birth') }}"
                    :error.sync="dateOfBirth.error"
                ></datepicker>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_doc_type') }}</label>
                <div class="group-control {{ $errors->has('doc_type') ? 'is-invalid' : ''}}">
                    <select name="doc_type" class="form-control kt-selectpicker {{ $errors->has('doc_type') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.crew_members_select_doc_type') }}</option>
                        @foreach(['passport', 'id_card', 'drivers_license'] as $doc_type)
                            <option value="{{ $doc_type }}"
                                {{ old('doc_type', $crewMember->doc_type ?? '') == $doc_type ? 'selected' : '' }}>{{ __('staff/forms.crew_members_doc_type_'.$doc_type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('doc_type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_doc_number') }}</label>
                <input type="text" class="form-control {{ $errors->has('doc_number') ? 'is-invalid' : ''}}" name="doc_number" value="{{ old('doc_number', $crewMember->doc_number ?? '') }}">
                {!! $errors->first('doc_number', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- nationality country --}}
            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_nationality_country') }}</label>
                <select2
                    name="nationality_country_id"
                    initial="{{ old('nationality_country_id', $crewMember->nationality_country_id ?? '') }}"
                    v-model="nationalityCountry.value"
                    :options.sync="nationalityCountry.options"
                    placeholder="{{ __('staff/forms.crew_members_select_nationality_country') }}"
                    error="{{ $errors->first('nationality_country_id') }}"
                ></select2>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_type') }}</label>
                <div class="group-control {{ $errors->has('type') ? 'is-invalid' : ''}}">
                    <select name="type" class="form-control kt-selectpicker {{ $errors->has('type') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.crew_members_select_type') }}</option>
                        @foreach(['hired', 'freelancer'] as $type)
                            <option value="{{ $type }}"
                                {{ old('type', $crewMember->type ?? '') == $type ? 'selected' : '' }}>{{ __('staff/forms.crew_members_type_'.$type) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            {{-- position --}}
            <div class="form-group">
                <label>{{ __('staff/forms.crew_members_position') }}</label>
                <input type="text" class="form-control {{ $errors->has('position') ? 'is-invalid' : ''}}" name="position" value="{{ old('position', $crewMember->position ?? '') }}">
                {!! $errors->first('position', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.crew_members_status') }}</label>
                <div class="group-control {{ $errors->has('status') ? 'is-invalid' : ''}}">
                    <select name="status" class="form-control kt-selectpicker {{ $errors->has('status') ? 'is-invalid' : ''}}">
                        <option value="">{{ __('staff/forms.crew_members_select_status') }}</option>
                        @foreach(['enabled', 'disabled', 'dismissed'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status', $crewMember->status ?? '') == $status ? 'selected' : '' }}>{{ __('staff/forms.crew_members_status_'.$status) }}</option>
                        @endforeach
                    </select>
                </div>
                {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
    </div>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.crew-members.partials.sections.crud.contact-details')

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.crew-members.partials.sections.crud.spoken-languages')

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
    @include ('admin.crew-members.partials.sections.crud.uploads')
</div>
<div class="kt-portlet__foot">
    <div class="kt-form__actions">
        <button type="submit" class="btn btn-primary">{{ __('staff/buttons.submit') }}</button>
        <a href="{{ route('admin.crew_members.index') }}" title="Back" class="btn btn-secondary">
        	{{ __('staff/buttons.cancel') }}
        </a>
    </div>
</div>