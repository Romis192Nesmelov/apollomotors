@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-md-9 col-sm-12 border-end px-3">
            <x-head level="1">{{ $article->head }}</x-head>
            {!! $article->text !!}
        </div>
        <div class="col-md-3 col-sm-12">
            <x-head level="3">{{ trans('content.another_articles') }}</x-head>
            @foreach ($articles as $article)
                <div class="w-100 border-bottom p-3 fs-6">
                    <a href="{{ route('articles',$article->slug) }}">{{ $article->head }}</a>
                </div>
            @endforeach
        </div>
    </x-section>
@endsection
