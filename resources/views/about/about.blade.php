@extends('layouts.main')

@section('content')
    <x-section class="gray">
        <h2>{{ $content->head }}</h2>
        {!! $content->text !!}
    </x-section>
    <x-section>
        @for ($i=1;$i<=6;$i++)
            @include('blocks.fancybox_block',[
                'image' => 'storage/images/about/image'.$i.'.jpg',
                'addClass' => 'col-lg-2 col-md-12 p-1 framed-image'
            ])
        @endfor
    </x-section>
    @include('blocks.hr_block')
    @include('blocks.for_each_client_block')
@endsection
