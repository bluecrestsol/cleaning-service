@extends('layouts.admin.index')
@section('title',  __('staff/titles.faqs_categories_questions_view'))

@section('content')

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-question-circle"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                     {{ __('staff/titles.faqs_categories_questions_view_page') . " {$faqCategory->name}" }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">

            @foreach ($languages as $language)
                <div class="form-group">
                    <label>{{ __('staff/forms.faqs_categories_questions_question') }} ({{ $language->english_name }})</label>
                    <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                        {{ __('staff/forms.faqs_categories_questions_language_status_'.$language->status_public) }}
                    </span>
                    <br>
                    {{  $faqQuestion->getTranslation('question', $language->code, false) }}
                </div>

                <div class="form-group">
                    <label>{{ __('staff/forms.faqs_categories_questions_answer') }} ({{ $language->english_name }})</label>
                    <span class="kt-badge kt-badge--{{ ($language->status_public == 'enabled') ? 'success' : ($language->status_public == 'disabled' ? 'danger' : 'warning') }} kt-badge--inline">
                        {{ __('staff/forms.faqs_categories_questions_language_status_'.$language->status_public) }}
                    </span>
                    <br>
                    {{  $faqQuestion->getTranslation('answer', $language->code, false) }}
                </div>
            @endforeach

            <div class="form-group form-group-last">
                <label>{{ __('staff/forms.faqs_categories_questions_status') }}</label>
                <br />
                <span class="kt-badge kt-badge--{{ ($faqQuestion->status == 'enabled') ? 'success' : 'danger' }} kt-badge--inline">
                    {{ __('staff/forms.faqs_categories_questions_status_'.$faqQuestion->status) }}
                </span>
            </div>

        </div>        
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <a href="{{ route('admin.faqs_categories.questions.index', $faqCategory->id) }}" class="btn btn-secondary">{{ __('staff/buttons.back') }}</a>
            </div>
        </div> 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/faqs/categories/questions/view.js') }}" type="text/javascript"></script>
@endsection

