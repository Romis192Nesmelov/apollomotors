@extends('layouts.main')

@section('content')
    @include('blocks.brands_modal_block')

    @if (count($actions))
        <div id="actions-block" class="owl-carousel mt-3">
            @foreach ($actions as $action)
                @include('blocks.action_block')
            @endforeach
        </div>
    @endif

    @include('blocks.brands_block', ['addClass' => 'mt-5'])

    <x-section class="gray">
        <div class="col-md-3 col-sm-6 col-xs-12 row m-0">
            @for ($i=1;$i<=5;$i++)
                @include('blocks.fancybox_block',[
                    'image' => 'storage/images/about/image'.$i.'.jpg',
                    'addClass' => $i == 1 ? 'col-12 p-1' : 'col-lg-6 col-md-12 p-1'
                ])
            @endfor
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12 p-4">
            <h2>{{ $content->head }}</h2>
            {!! $content->text !!}
        </div>
    </x-section>

    <x-section>
        @for ($i=1;$i<=6;$i++)
            <div class="col-md-2 col-sm-4 col-xs-12 text-center">
                <img class="w-50 mb-1" src="{{ asset('storage/images/icons/icon'.$i.'.svg') }}" />
                <p class="fs-6 text-center"><b>{!! trans('content.icon'.$i) !!}</b></p>
            </div>
        @endfor
    </x-section>

    @include('blocks.hr_block')

    <x-section class="add-content">
        <x-head level="2">{{ trans('content.we_offer_repairs') }}</x-head>
        @foreach ($offers_repair as $k => $repair)
            <div class="col-md-3 col-sm-6 col-xs-12 text-center p-3 image {{ count($offers_repair) > 8 && $k > 7 ? 'full-content' : '' }}">
                <a href="{{ route('repair') }}">
                    <img class="mb-2" src="{{ asset($repair->image) }}" />
                    <p class="fs-6 text-center mb-0"><b>{{ $repair->name }}</b></p>
                </a>
            </div>
        @endforeach
        @if (count($offers_repair) > 8)
            <div class="w-100 pt-3 pr-3">
                @include('blocks.button_block',[
                    'primary' => false,
                    'addClass' => 'float-end show-more',
                    'buttonText' => trans('content.details')
                ])
                @include('blocks.button_block',[
                    'primary' => false,
                    'addClass' => 'float-end d-none hide-more',
                    'buttonText' => trans('content.collapse')
                ])
            </div>
        @endif
    </x-section>

    <x-section class="gray">
        <div class="col-md-6 col-sm-12">
            <h2>{{ trans('content.free_check') }}</h2>
            <div class="accordion accordion-flush" id="freeCheck">
                @foreach ($free_checks as $k => $freeCheck)
                    <x-accordion itemId="check{{ $k }}" parentId="freeCheck" itemHead="{{ $freeCheck->name }}">
                        <ul>
                            @foreach ($freeCheck->checks as $check)
                                <li>{{ $check->name }}</li>
                            @endforeach
                        </ul>
                    </x-accordion>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 d-md-block d-sm-none text-center">
            <img src="{{ asset('storage/images/logo_3d.png') }}" class="w-75 mt-5" />
        </div>
    </x-section>

    <x-section>
        <x-head level="2">{{ trans('content.our_prices') }}</x-head>
        <div class="rounded-block" id="our-prices">
            <nav>
                <div class="nav nav-tabs" role="tablist">
                    @foreach ($electedBrands as $k => $brand)
                        <a
                            class="nav-link text-center {{ !$k ? 'active' : '' }}"
                            id="{{ $brand->slug }}-tab"
                            data-bs-toggle="tab"
                            href="#{{ $brand->slug }}"
                            role="tab"
                            aria-controls="{{ $brand->slug }}"
                            title="{{ $brand['name_'.app()->getLocale()] }}"
                            aria-selected="{{ !$k ? 'true' : 'false' }}"
                            style="width: {{ 100 / count($electedBrands) }}%"
                        >
                            <img src="{{ asset($brand->logo) }}">
                        </a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach ($electedBrands as $k => $brand)
                    <div class="tab-pane fade {{ !$k ? 'show active' : '' }}" id="{{ $brand->slug }}" role="tabpanel" aria-labelledby="{{ $brand->slug }}-tab">
                        @include('blocks.home_price_part_block',[
                            'start' => 0,
                            'end' => round(count($brand->prices)/2)
                        ])
                        @include('blocks.home_price_part_block',[
                            'start' => count($brand->prices)/2 + 1,
                            'end' => count($brand->prices)
                        ])
                    </div>
                @endforeach
            </div>
        </div>
        <p class="fs-6 w-100 text-center mt-4">{{ trans('content.price_footnote') }}</p>
    </x-section>

    @include('blocks.hr_block')

    <x-section>
        <h2>{{ trans('content.do_you_know_that') }}</h2>
        @include('blocks.accordion_block',['id' => 'faq'])
    </x-section>

    <x-section>
        @include('blocks.online_record_block',['type' => 'online_appointment_for_repair'])
    </x-section>

    @include('blocks.for_each_client_block')

    <x-section>
        <x-head level="2">{{ trans('content.we_are_trusted') }}</x-head>
        <div id="clients-block" class="owl-carousel">
            @foreach ($clients as $client)
                <img class="w-50 m-auto" title="{{ $client->name }}" src="{{ asset($client->image) }}" />
            @endforeach
        </div>
    </x-section>
@endsection
