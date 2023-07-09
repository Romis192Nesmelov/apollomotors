@extends('layouts.main')

@section('content')
    @if (count($actions))
        <div id="actions-block" class="owl-carousel">
            @foreach ($actions as $action)
                <div class="action" style="background: url({{ asset($action->image) }}) center;">
                    <table>
                        <tr>
                            <td><h1>{!! $action->text !!}</h1></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#" action-id="{{ $action->id }}" class="action-record">
                                    @include('blocks.button_block',[
                                        'primary' => true,
                                        'buttonText' => trans('content.sign_up')
                                    ])
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <x-section>
        <div id="brands-block" class="owl-carousel pt-5">
            @foreach ($brands as $brand)
                <a href="#"><img class="w-75 m-auto" title="{{ $brand->ru }}" src="{{ asset($brand->logo) }}" /></a>
            @endforeach
        </div>
    </x-section>

    <x-section class="gray">
        <div class="col-md-3 col-sm-6 col-xs-12 row m-0">
            @for ($i=1;$i<=5;$i++)
                @include('blocks.fancybox_block',[
                    'image' => 'storage/images/about/image'.$i.'.jpg',
                    'addClass' => $i == 1 ? 'col-12 p-1' : 'col-lg-6 col-md-12 p-1',
                    'iconBlack' => false
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

    <x-section>
        <h2 class="text-center w-100">{{ trans('content.we_offer_repairs') }}</h2>
        @foreach ($offers_repair as $k => $repair)
            <div class="col-md-3 col-sm-6 col-xs-12 text-center p-3 image {{ count($offers_repair) > 8 && $k > 7 ? 'more-offers-repair' : '' }}">
                <img class="mb-2" src="{{ asset($repair->image) }}" />
                <p class="fs-4 text-center mb-0"><b>{{ $repair->name }}</b></p>
            </div>
        @endforeach
        @if (count($offers_repair) > 8)
            <div class="w-100 pt-3 pr-3">
                @include('blocks.button_block',[
                    'id' => 'show-more-offers-repair',
                    'primary' => false,
                    'addClass' => 'float-end',
                    'buttonText' => trans('content.details')
                ])
                @include('blocks.button_block',[
                    'id' => 'collapse-more-offers-repair',
                    'primary' => false,
                    'addClass' => 'float-end d-none',
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
        <h2 class="text-center w-100">{{ trans('content.our_prices') }}</h2>
        <div class="rounded-block" id="our-prices">
            <nav>
                <div class="nav nav-tabs" role="tablist">
                    @foreach ($electedBrands as $k => $brand)
                        <a
                            class="nav-link text-center {{ !$k ? 'active' : '' }}"
                            id="{{ $brand->name }}-tab"
                            data-bs-toggle="tab"
                            href="#{{ $brand->name }}"
                            role="tab"
                            aria-controls="{{ $brand->name }}"
                            title="{{ $brand->name }}"
                            aria-selected="{{ !$k ? 'true' : 'false' }}"
                            style="width: {{ 100 / count($electedBrands) }}%"
                        >
                            <img src="{{ asset($brand->image) }}">
                        </a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach ($electedBrands as $k => $brand)
                    <div class="tab-pane fade {{ !$k ? 'show active' : '' }}" id="{{ $brand->name }}" role="tabpanel" aria-labelledby="{{ $brand->name }}-tab">
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
        <div class="accordion accordion-flush" id="faq">
            @foreach ($questions as $k => $item)
                <x-accordion itemId="question{{ $k }}" parentId="faq" icon="fa fa-lightbulb-o" itemHead="{{ $item->question }}">{{ $item->answer }}</x-accordion>
            @endforeach
        </div>
    </x-section>

    <x-section>
        <div class="rounded-block record-repair">
            <h2>{{ trans('content.record_for_repair') }}</h2>
            @include('blocks.request_form_block',['textarea' => false])
        </div>
    </x-section>

    <x-section>
        <h2 class="w-100 text-center">{{ trans('content.in_the_waiting_room_for_each_client') }}</h2>
        @foreach (['fa fa-wifi', 'icon-cup2', 'icon-tv', 'icon-eye'] as $k => $icon)
            @include('blocks.big_icon_block',[
                'colMd' => 3,
                'colSm' => 6,
                'icon' => $icon,
                'iconText' => trans('content.for_each_client_icon'.($k+1))
            ])
        @endforeach
    </x-section>

    @include('blocks.hr_block')

    <x-section>
        <h2 class="w-100 text-center">{{ trans('content.with_care_for_each_client_with_us') }}</h2>
        @foreach (['icon-alarm-check','icon-bubbles3','icon-cogs','icon-bookmark','icon-video-camera3',' icon-wallet','icon-trophy3','icon-gift'] as $k => $icon)
            @include('blocks.big_icon_block',[
                'colMd' => 3,
                'colSm' => 6,
                'icon' => $icon,
                'iconText' => trans('content.care_icon'.($k+1))
            ])
        @endforeach
    </x-section>

    @include('blocks.hr_block')

    <x-section>
        <h2 class="w-100 text-center">{{ trans('content.we_are_trusted') }}</h2>
        <div id="clients-block" class="owl-carousel pt-5">
            @foreach ($clients as $client)
                <img class="w-50 m-auto" title="{{ $client->name }}" src="{{ asset($client->image) }}" />
            @endforeach
        </div>
    </x-section>
@endsection
