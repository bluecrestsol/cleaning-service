<div class="kt-section">
    <h3 class="kt-section__title">{{ __('staff/forms.crew_members_spoken_languages') }}</h3>
    <div class="kt-section__body">
        <div class="row">
            <div class="col">
                @if (!empty($crewMember->languages))
                    @foreach ($crewMember->languages->sortBy('english_name') as $language)
                        <span class="kt-badge kt-badge--inline kt-badge--primary">{{ $language->english_name }}</span>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>