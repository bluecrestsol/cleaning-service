@extends('layouts.admin.index')
@section('title',  __('staff/titles.crew_members_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-user-shield"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.crew_members_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_title') }}</label>
                        <br>
                        {{ !empty($crewMember->title) ? __('staff/forms.crew_members_title_'.$crewMember->title) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_first_name') }}</label>
                        <br>
                        {{ $crewMember->first_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_middle_name') }}</label>
                        <br>
                        {{ $crewMember->middle_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_last_name') }}</label>
                        <br>
                        {{ $crewMember->last_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_gender') }}</label>
                        <br>
                        {{ !empty($crewMember->gender) ? __('staff/forms.crew_members_gender_'.$crewMember->gender) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_date_of_birth') }}</label>
                        <br>
                        {{ optional($crewMember->date_of_birth)->format('F d, Y') }} @if (!empty($crewMember->age)) ({{ $crewMember->age }}) @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_doc_type') }}</label>
                        <br>
                        {{ !empty($crewMember->doc_type) ? __('staff/forms.crew_members_doc_type_'.$crewMember->doc_type) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_doc_number') }}</label>
                        <br>
                        {{ $crewMember->doc_number ?? '' }}
                    </div>
                    {{-- nationality country --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_nationality_country') }}</label>
                        <br>
                        {{ $crewMember->nationality_country->name ?? '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_type') }}</label>
                        <br>
                        @if (!empty($crewMember->type))
                            <span class="kt-badge kt-badge--{{ $crewMember->type == 'hired' ? 'primary' : 'dark' }} kt-badge--inline">
                                {{ __('staff/forms.crew_members_type_'.$crewMember->type) }}
                            </span>
                        @endif
                    </div>
                    {{-- position --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.crew_members_position') }}</label>
                        <br>
                        {{ $crewMember->position ?? '' }}
                    </div>
                    <div class="form-group form-group-last">
                        <label>{{ __('staff/forms.crew_members_status') }}</label>
                        <br>
                        @if (!empty($crewMember->status))
                            <span class="kt-badge kt-badge--{{ $crewMember->status == 'enabled' ? 'success'
                                : ($crewMember->status == 'disabled' ? 'danger' : 'dark') }} kt-badge--inline">
                                {{ __('staff/forms.crew_members_status_'.$crewMember->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.crew-members.partials.sections.show.contact-details')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.crew-members.partials.sections.show.spoken-languages')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.crew-members.partials.sections.show.uploads')

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.crew_members.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/crew-members/view.js') }}" type="text/javascript"></script>
@endsection