@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-md-9 col-sm-12 border-end px-3">
            <h1 class="text-center w-100">{{ $article->head }}</h1>
            {!! $article->text !!}
        </div>
        <div class="col-md-3 col-sm-12">
            <h3 class="w-100 text-center">{{ trans('content.another_articles') }}</h3>
            @foreach ($articles as $article)
                <div class="w-100 border-bottom p-3 fs-6">
                    <a href="{{ route('articles',$article->slug) }}">{{ $article->head }}</a>
                </div>
            @endforeach
        </div>
    </x-section>
@endsection
