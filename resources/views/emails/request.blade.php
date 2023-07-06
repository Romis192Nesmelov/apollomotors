@extends('layouts.mail')

@section('content')
    <h2>{{ trans('content.'.$type) }} с сайта {{ env('APP_NAME') }}</h2>
    @if (isset($action) && $action)
        <h3>Акция: «{{ $action }}»</h3>
    @endif
    @if (isset($name) && $name)
        <p>От пользователя с именем: {{ $name }}</p>
    @endif
    <p>Телефон: {{ $phone }}</p>
    @if (isset($comment) && $comment)
        <p><b>Текст комментария:</b></p>
        <p>{{ $comment }}</p>
    @endif
@endsection
