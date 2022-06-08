@extends('layouts.app')

@section('template_title')
    Welcome
@endsection

@section('head')
    <!-- Scripts-->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 text-center">
                <img src="{{ asset('img/giphy.webp') }}" alt="">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
