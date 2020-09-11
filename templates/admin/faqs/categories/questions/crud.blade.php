@extends('layouts.admin.index')
@section('title', isset($faqQuestion) ? __('staff/titles.faqs_categories_questions_edit') : __('staff/titles.faqs_categories_questions_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-question-circle"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($faqQuestion) ? __('staff/titles.faqs_categories_questions_edit_page') .' '. $faqCategory->name
                        : __('staff/titles.faqs_categories_questions_create_page') .' '. $faqCategory->name }}
                </h3>
            </div>
        </div>

        @if (isset($faqQuestion))
            {!! Form::open(['route' => ['admin.faqs_categories.questions.update', $faqCategory->id, $faqQuestion->id], 
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => ['admin.faqs_categories.questions.store', $faqCategory->id],
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.faqs.categories.questions.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/faqs/categories/questions/crud.js') }}" type="text/javascript"></script>
@endsection