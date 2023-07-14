@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-12">
            <h1 class="w-100 text-center">{{ trans('menu.'.$activeMenu).' '.$car->brand['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'en' : 'ru')].' ('.$car->brand['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].' '.$car['name_'.(app()->getLocale() == 'en' ? 'ru' : 'en')].')' }}</h1>
            @include('blocks.fancybox_block',[
                'image' => $car->image_full,
                'preview' => $car->image_preview,
                'addClass' => 'col-md-4 col-sm-12 me-4 pull-left framed-image',
            ])
            @if ($activeMenu == 'repair')
                {!! $car->repairs[0]->text !!}
            @else
                {!! $car[$activeMenu]->text !!}
            @endif
        </div>

        @if ($activeMenu == 'repair')
            <h2 class="w-100 text-center mt-4">{{ trans('menu.'.$activeMenu).' '.$car->brand['name_'.app()->getLocale()].' '.$car['name_'.app()->getLocale()].' '.trans('content.prices') }}</h2>
            @include('issues.blocks.repair_table_block',['price' => $car->priceRepair])
            @include('issues.blocks.car_layout_bottom_block')
            @if (count($car->repairs) == 2)
                {!! $car->repairs[1]->text !!}
            @endif
        @elseif ($activeMenu == 'maintenance')
            @include('issues.blocks.maintenance_table_block',['car' => $car->brand['name_'.app()->getLocale()].' '.$car['name_'.app()->getLocale()]])
            @include('issues.blocks.car_layout_bottom_block')
        @endif

    </x-section>
@endsection
