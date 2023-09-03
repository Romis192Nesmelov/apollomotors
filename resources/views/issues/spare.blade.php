@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-12">
            <x-head level="1">
                {{ $spare->head }}
                {{ trim(view('issues.blocks.car_name_block',['car' => $spare->car, 'simple' => false])->render()).'.' }}
                <span class="head-price">
                    {{ trans('content.price') }}
                    @include('issues.blocks.table_list_price_block', ['price_from' => $spare->price_non_original_from, 'price' => $spare->price_non_original])
                </span>
            </x-head>
            @include('blocks.fancybox_block',[
                'image' => $spare->car->image_full,
                'preview' => $spare->car->image_preview,
                'addClass' => 'col-md-4 col-sm-12 me-4 pull-left framed-image',
            ])
            {!! $spare->text !!}
        </div>
    </x-section>
@endsection
