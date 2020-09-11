<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.crew_members_contact_details') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_email') }}</label>
            <br>
            {{ $crewMember->email }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_mobile') }}</label>
            <br>
            {{ $crewMember->mobile_number }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_phone') }}</label>
            <br>
            {{ $crewMember->phone }}
        </div>
        <div class="form-group">
            <label>{{ __('staff/forms.crew_members_contact_details_line') }}</label>
            <br>
            {{ $crewMember->line }}
        </div>
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.crew_members_contact_details_whatsapp') }}</label>
            <br>
            {{ $crewMember->whatsapp }}
        </div>
    </div>
</div>