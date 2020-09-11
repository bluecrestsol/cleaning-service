<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.agents_contact_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.agents_contact_details_email') }}</label>
            <br>
            {{ $agent->email }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.agents_contact_details_mobile') }}</label>
            <br>
            {{ $agent->mobile_number }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.agents_contact_details_phone') }}</label>
            <br>
            {{ $agent->phone }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.agents_contact_details_line') }}</label>
            <br>
            {{ $agent->line }}
        </div>
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.agents_contact_details_whatsapp') }}</label>
            <br>
            {{ $agent->whatsapp }}
        </div>
    </div>
</div>