@extends('layouts.main')

@section('content')
    @include('blocks.brands_modal_block')
    <x-section>
        @include('blocks.brands_block')
        <div class="col-12">
            <x-head level="1">
                {{ trans('menu.'.$activeMenu).' ' }}
                @if (isset($brand))
                    @include('issues.blocks.brand_name_block', ['simple' => false])
                @endif
            </x-head>
            @include('blocks.fancybox_block',[
                'image' => 'storage/images/brands/def_brand_image.jpg',
                'addClass' => 'col-md-4 col-sm-12 me-4 pull-left framed-image',
            ])
            {!! $contents[0]->text !!}
        </div>
            @if ($activeMenu == 'repair')
                <x-head level="2" class="mt-4">
                    {{ trans('menu.'.$activeMenu).' ' }}
                    @if (isset($brand))
                        @include('issues.blocks.brand_name_block', ['simple' => false])
                    @endif
                    {{ ' '.trans('content.prices') }}
                </x-head>
                @include('issues.blocks.repair_table.repair_table_block',[
                    'price' => $contents[0]->priceRepairsActive,
                    'brand' => $brand ?? null
                ])
                {!! $contents[1]->text !!}
            @endif
            @include('blocks.online_record_block',[
                'type' => 'online_appointment_for_'.$activeMenu,
                'addClass' => 'mt-4'
            ])
    </x-section>

    @if (isset($brand) && count($brand->actions))
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
@endsection
