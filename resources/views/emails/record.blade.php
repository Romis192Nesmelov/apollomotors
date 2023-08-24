@extends('layouts.mail')

@section('content')
    <h1>{{ $fields['title'] }}</h1>
    <h4>{{ trans('admin_content.from').': '.$fields['name'] }}</h4>

    @if (isset($fields['email']) && $fields['email'])
        <h4>E-mail: {{ $fields['email'] }}</h4>
    @endif

    <h4>{{ trans('admin_content.phone').': '.$fields['phone'] }}</h4>
{{--    <h4>{{ trans('admin_content.car').': '.$fields['car'] }}</h4>--}}

    @if (isset($fields['work']))
        <h4>{{ trans('admin_content.repair_description') }}</h4>
        <p>{{ $fields['work'] }}</p>
    @elseif(isset($fields['radius']))
        <h4>{{ trans('admin_content.radius', ['radius' => $fields['radius']]) }}</h4>
    @elseif(isset($fields['spares']))
        <h4>{{ trans('admin_content.required_spares') }}</h4>
        <p>{{ $fields['spares'] }}</p>
    @endif

    @if (isset($fields['url']) && $fields['url'])
        <h4>{{ trans('admin_content.request_sent_from_page', ['url' => $fields['url']]) }}</h4>
    @endif
@endsection