@extends('layouts.admin.index')
@section('title',  __('staff/titles.bookings_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fas fa-clipboard-list"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{__('staff/titles.bookings_view')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first kt-section--last">
                <div class="kt-section__body">
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_status') }}</label>
                        <br />
                        <span class="kt-badge kt-badge--{{ $booking->status == 'new' ? 'primary'
                            : ($booking->status == 'processed' ? 'success' : 'danger') }} kt-badge--inline">
                            {{ __('staff/forms.bookings_status_'.$booking->status) }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_created_at') }}</label>
                        <br>
                        {{ $booking->created_at }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_booked_at') }}</label>
                        <br>
                        {{ $booking->booked_at }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_name') }}</label>
                        <br>
                        {{ $booking->name }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_business_name') }}</label>
                        <br>
                        {{ $booking->business_name }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_category') }}</label>
                        <br>
                        {{ $booking->category->name ?? '' }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_email') }}</label>
                        <br>
                        {{ $booking->email }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_phone') }}</label>
                        <br>
                        {{ $booking->phone }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_area') }}</label>
                        <br>
                        {{ $booking->area }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_service') }}</label>
                        <br>
                        {{ optional($booking->service)->name }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_address') }}</label>
                        <br>
                        {{ $booking->address }}
                    </div>
                    <div class="form-group">
                        <label>{{ __('staff/forms.bookings_notes') }}</label>
                        <br>
                        {{ $booking->notes }}
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/bookings/view.js') }}" type="text/javascript"></script>
@endsection
