@extends('layouts.main')

@section('content')
    <x-section>
        <div class="col-12">
            <x-head level="1">
                {{ trans('menu.'.$activeMenu).' ' }}
                @include('issues.blocks.car_name_block',['simple' => false])
            </x-head>
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
            <x-head level="2" class="mt-4">
                {{ trans('menu.'.$activeMenu).' ' }}
                @include('issues.blocks.car_name_block',['simple' => true])
                {{ ' '.trans('content.prices') }}
            </x-head>
            @include('issues.blocks.repair_table.repair_table_block',['price' => $car->priceRepairs])
            @if (count($car->repairs) == 2)
                <div>
                    {!! $car->repairs[1]->text !!}
                </div>
            @endif
        @elseif ($activeMenu == 'maintenance')
            @include('issues.blocks.maintenance_table.maintenance_table_block',['car' => $car->brand['name_'.app()->getLocale()].' '.$car['name_'.app()->getLocale()]])
        @else
            @include('issues.blocks.spares_table.spares_table_block',['spares' => $car->spares])
        @endif
        @include('issues.blocks.car_layout_bottom_block')

        @include('blocks.online_record_block',[
            'type' => 'online_appointment_for_'.$activeMenu,
            'addClass' => 'mt-4'
        ])
    </x-section>
@endsection
