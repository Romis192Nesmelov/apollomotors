@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-12">
            <h1 class="w-100 text-center">{{ trans('menu.'.$activeMenu).' '.$brand['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}</h1>
            @include('blocks.fancybox_block',[
                'image' => 'storage/images/brands/'.$brand->slug.'_image.jpg',
                'addClass' => 'col-md-4 col-sm-12 me-4 pull-left framed-image',
            ])
            @if ($activeMenu == 'maintenance')
                {!! $brand->maintenances[0]->text !!}
            @else
                {!! $brand[$activeMenu]->text !!}
            @endif
        </div>
        @include('issues.blocks.phone_plate_block')
        @include('blocks.online_record_block',[
            'type' => 'online_appointment_for_repair',
            'addClass' => 'mt-4'
        ])
        <div class="row">
            @foreach ($brand->cars as $car)
                @if ($car->active && $car[$activeMenu])
                    <div class="col-md-3 col-sm-6 col-xs-12 mt-5 framed-image">
                        <a href="{{ route($activeMenu,[$brand->slug, $car->slug]) }}">
                            <img title="{{ $car['name_'.app()->getLocale()] }}" src="{{ asset($car->image_preview) }}" />
                            <p class="w-100 text-center mt-2 fs-6">{{ $brand['name_'.app()->getLocale()].' '.$car['name_'.app()->getLocale()] }}</p>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        @if ($activeMenu == 'maintenance' && count($brand->maintenances) == 2)
            {!! $brand->maintenances[1]->text !!}
        @endif
    </x-section>
@endsection
