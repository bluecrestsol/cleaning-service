@extends('layouts.admin.index')
@section('title', isset($faqQuestion) ? __('staff/titles.faqs_questions_edit') : __('staff/titles.faqs_questions_create'))

@section('content')
    @include('admin.partials.pre_data')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand fa fa-question-circle"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    {{ isset($faqQuestion) ? __('staff/titles.faqs_questions_edit') : __('staff/titles.faqs_questions_create') }}
                </h3>
            </div>
        </div>

        @if (isset($faqQuestion))
            {!! Form::open(['route' => ['admin.faqs_questions.update', $faqQuestion->id], 
                'id' => 'main-form',
                'method' => 'PUT',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @else
            {!! Form::open(['route' => ['admin.faqs_questions.store'],
                'id' => 'main-form',
                'method' => 'POST',
                'class' => 'kt-form form-horizontal',
                'autocomplete' => 'off',
                'files' => true]) !!}
        @endif

        @include ('admin.faqs.partials.form')

        {!! Form::close() !!}

                 
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/admin/faqs/crud.js') }}" type="text/javascript"></script>
@endsection