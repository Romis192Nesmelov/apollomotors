@extends('layouts.main')

@section('content')
    <x-section>
        <x-head level="1">{{ $content->head }}</x-head>
        {!! $content->text !!}
    </x-section>
@endsection
