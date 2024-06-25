@extends('layouts.main')

@section('content')
<x-section>
    <div class="col-12">
        <x-head level="1">
            {{ trans('menu.'.$activeMenu).' ' }}
            @include('issues.blocks.brand_name_block', ['simple' => false])
        </x-head>
        @include('blocks.fancybox_block',[
            'image' => $brand->image,
            'addClass' => 'col-md-4 col-sm-12 me-4 pull-left framed-image',
        ])
        @if ($activeMenu == 'repair' || $activeMenu == 'maintenance')
            {!! $brand[$activeMenu.'s'][0]->text !!}
        @else
            {!! $brand[$activeMenu]->text !!}
        @endif
    </div>
    @php $existCars = false; @endphp
    <div class="row">
        @foreach ($brand->cars as $car)
            @if ($car->active && ($activeMenu == 'repair' ? count($car->repairs) : $car[$activeMenu]) )
                @php $existCars = true; @endphp
                <div class="col-md-3 col-sm-6 col-xs-12 mt-5 framed-image">
                    <a href="{{ route($activeMenu,[$brand->slug, $car->slug]) }}">
                        <img title="{{ view('issues.blocks.car_name_block', ['car' => $car, 'simple' => true])->render() }}" src="{{ asset($car->image_preview) }}" />
                        <p class="w-100 text-center mt-2 fs-6">{{ view('issues.blocks.car_name_block', ['car' => $car, 'simple' => true])->render() }}</p>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    @if ($existCars)
        @include('issues.blocks.phone_plate_block')
    @endif
    @if ( ($activeMenu == 'maintenance' || $activeMenu == 'repair') && count($brand[$activeMenu.'s']) == 2 )
        {!! $brand[$activeMenu.'s'][1]->text !!}
    @endif
</x-section>
@if (count($brand->actions))
    <x-section class="gray">
        <x-head level="1">
            {{ trans('content.promotions_for') }}
            @include('issues.blocks.brand_name_block', ['simple' => false])
        </x-head>
        <div id="actions-brand-block" class="owl-carousel mt-2">
            @foreach ($brand->actions as $action)
                @include('actions.blocks.action_block')
            @endforeach
        </div>
    </x-section>
@endif
<x-section>
    @include('blocks.online_record_block',[
        'type' => 'online_appointment_for_'.$activeMenu,
        'addClass' => 'mt-4'
    ])
</x-section>
@endsection
