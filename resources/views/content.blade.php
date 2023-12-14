@extends('layouts.main')

@section('content')
    <x-section>
        @if (isset($content->head) && $content->head)
            <x-head level="1">{{ $content->head }}</x-head>
        @endif
        {!! $content->text !!}
    </x-section>
@endsection
