@extends('layouts.main')

@section('content')
    <x-section>
        <x-head level="1">{{ trans('menu.articles') }}</x-head>
        @foreach ($articles as $article)
            <div class="col-md-4 col-sm-6 col-xs-12 article-announcement">
                <h3 class="text-left"><a href="{{ route('articles',$article->slug) }}">{{ $article->head }}</a></h3>
                @include('blocks.cropped_content_block',['content' => $article->text, 'length' => 250])
            </div>
        @endforeach
    </x-section>
@endsection
