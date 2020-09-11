@extends('layouts.admin.index')
@section('title', 'Dashboard')

@section('content')

    @if(session('fail'))
        <div class="alert alert-danger">
            {!! session('fail') !!}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {!! session('success') !!}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('page_script')
    <script src="{{ url('js/admin/dashboard/index.js') }}" type="text/javascript"></script>
@endsection


