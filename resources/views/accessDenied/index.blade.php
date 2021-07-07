@extends('layout')

@section('title')
Access Denied
@endsection

@section('content')

<div class="web-content">
    <h2>{{ $messages["accessDenied.text"] }}</h2>

    <a href="{{ route('showHome') }}">{{ $messages["accessDenied.backHome"] }}</a>
</div>

@endsection
