@extends('layouts.admin.index')
@section('title',  __('staff/titles.appointments_view'))

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-calendar-check"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.appointments_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_status') }}</label>
                <br>
                <span class="kt-badge kt-badge--inline {{ $appointment->status == 'booked' ? 'kt-badge--primary' : ($appointment->status == 'completed'
                    ? 'kt-badge--success': 'kt-badge--danger') }}">{{ __('staff/forms.appointments_status_'.$appointment->status) }}</span>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_customer_code') }}</label>
                <br>
                {{ $appointment->customer->code ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_customer_title') }}</label>
                <br>
                {{ __('staff/forms.appointments_customer_title_'.($appointment->customer->title ?? '')) }}
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_customer_first_name') }}</label>
                <br>
                {{ $appointment->customer->first_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_customer_last_name') }}</label>
                <br>
                {{ $appointment->customer->last_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_customer_business_name') }}</label>
                <br>
                {{ $appointment->customer->business_name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_place') }}</label>
                <br>
                {{ $appointment->place->name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_contract') }}</label>
                <br>
                {{ !empty($appointment->contract) ? $appointment->contract->code .' '. optional($appointment->contract->started_at)->format('F d, Y') .' - '. optional($appointment->contract->ended_at)->format('F d, Y') : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_ordered_at') }}</label>
                <br>
                {{ !empty($appointment->ordered_at) ? $appointment->ordered_at->setTimeZone(app('shared')->get('others')['timezone'])->format('F d, Y H:i:s') : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_scheduled_at') }}</label>
                <br>
                {{ !empty($appointment->scheduled_at) ? $appointment->scheduled_at->setTimeZone(app('shared')->get('others')['timezone'])->format('F d, Y H:i:s') : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_serviced_at') }}</label>
                <br>
                {{ !empty($appointment->serviced_at) ? $appointment->serviced_at->setTimeZone(app('shared')->get('others')['timezone'])->format('F d, Y H:i:s') : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_services') }}</label>
                <br>
                <ul class="mt-2">
                    @foreach (($appointment->services ?? []) as $index => $service)
                        <li>
                            {{ $service->name ?? '' }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_crew_leader') }}</label>
                <br>
                {{ ($appointment->crew_members[0]->first_name ?? '') . ' ' . ($appointment->crew_members[0]->last_name) }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_crew_members') }}</label>
                <br>
                <ul class="mt-2">
                    @foreach (($appointment->crew_members ?? []) as $index => $member)
                        @if (!$loop->first)
                            <li>
                                {{ implodeNotNull(' ', [
                                    ($member->first_name ?? null),
                                    ($member->middle_name ?? null),
                                    ($member->last_name ?? null)
                                ]) }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_currency') }}</label>
                <br>
                {{ $appointment->currency->name ?? '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_price') }}</label>
                <br>
                {{ isset($appointment->price) ? decimal(number_format($appointment->price, 2)) : '' }} 
            </div>

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_payment_terms') }}</label>
                <br>
                {{ __('staff/forms.appointments_payment_terms_'.($appointment->payment_term ?? '')) }}
            </div>

            @if ($appointment->payment_term == 'postpaid')
                <div class="form-group">
                    <label>{{ __('staff/forms.appointments_payment_due_at') }}</label>
                    <br>
                    {{ optional($appointment->payment_due_at)->format('F d, Y H:i:s') }} 
                </div>
            @endif

            <div class="form-group">
                <label>{{ __('staff/forms.appointments_payment_method') }}</label>
                <br>
                {{ __('staff/forms.appointments_payment_method_'.($appointment->payment_method ?? '')) }}
            </div>
        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/appointments/view.js') }}" type="text/javascript"></script>
@endsection

