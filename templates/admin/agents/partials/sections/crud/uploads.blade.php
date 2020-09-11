<div class="kt-section kt-section--last">
    <h3 class="kt-section__title">{{ __('staff/forms.agents_uploads') }}</h3>
    <div class="kt-section__body">
        <div class="form-group">
            <label>{{ __('staff/forms.agents_doc') }}</label>
            <input type="file" name="doc_file" class="form-control mb-1">
            @if (isset($agent) && isset($agent->doc_file))
                <span class="kt-font-danger">{{ $agent->doc_file }}</span>
            @endif
        </div>
        <div class="form-group form-group-last">
            <label>{{ __('staff/forms.agents_photo') }}</label>
            <input type="file" name="photo_file" class="form-control mb-3">
            @if (isset($agent) && isset($agent->photo_file))
                <img src="{{ asset('storage/'.$agent->photo_file) }}" class="img-fluid"/>
            @endif
        </div>
    </div>
</div>