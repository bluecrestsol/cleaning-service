@extends('layouts.admin.index')
@section('title',  __('staff/titles.agents_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-user-ninja"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.agents_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_title') }}</label>
                        <br>
                        {{ !empty($agent->title) ? __('staff/forms.agents_title_'.$agent->title) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_first_name') }}</label>
                        <br>
                        {{ $agent->first_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_middle_name') }}</label>
                        <br>
                        {{ $agent->middle_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_last_name') }}</label>
                        <br>
                        {{ $agent->last_name ?? '' }} 
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_gender') }}</label>
                        <br>
                        {{ !empty($agent->gender) ? __('staff/forms.agents_gender_'.$agent->gender) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_date_of_birth') }}</label>
                        <br>
                        {{ optional($agent->date_of_birth)->format('F d, Y') }} @if (!empty($agent->age)) ({{ $agent->age }}) @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_doc_type') }}</label>
                        <br>
                        {{ !empty($agent->doc_type) ? __('staff/forms.agents_doc_type_'.$agent->doc_type) : '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_doc_number') }}</label>
                        <br>
                        {{ $agent->doc_number ?? '' }}
                    </div>
                    {{-- nationality country --}}
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_nationality_country') }}</label>
                        <br>
                        {{ $agent->nationality_country->name ?? '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_type') }}</label>
                        <br>
                        @if (!empty($agent->type))
                            <span class="kt-badge kt-badge--{{ $agent->type == 'hired' ? 'primary' : 'dark' }} kt-badge--inline">
                                {{ __('staff/forms.agents_type_'.$agent->type) }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.agents_commission_rate') }}</label>
                        <br>
                        {{ !empty($agent->commission_rate) ? decimal(number_format($agent->commission_rate, 2)) : '' }} 
                    </div>
                    <div class="form-group form-group-last">
                        <label>{{ __('staff/forms.agents_status') }}</label>
                        <br>
                        @if (!empty($agent->status))
                            <span class="kt-badge kt-badge--{{ $agent->status == 'enabled' ? 'success'
                                : ($agent->status == 'disabled' ? 'danger' : 'dark') }} kt-badge--inline">
                                {{ __('staff/forms.agents_status_'.$agent->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.agents.partials.sections.show.contact-details')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.agents.partials.sections.show.spoken-languages')

            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            @include ('admin.agents.partials.sections.show.uploads')

        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/agents/view.js') }}" type="text/javascript"></script>
@endsection