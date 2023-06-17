@extends('layouts.main')

@section('content')
    @if (count($actions))
        <div id="actions-block" class="owl-carousel">
            @foreach($actions as $action)
                <div class="action" style="background: url({{ asset($action->image) }}) center;">
                    <table>
                        <tr>
                            <td><h1>{!! $action->text !!}</h1></td>
                        </tr>
                        <tr>
                            <td>
                                @include('blocks.button_block',[
                                    'primary' => true,
                                    'buttonText' => trans('content.sign_up')
                                ])
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <x-section class="brands">
        @foreach($brands as $brand)
            <div class="brand type{{ $brand->type + 1 }}">
                <a href="#" title="{{ ucfirst($brand->name) }}"><img src="{{ asset($brand->image) }}" /></a>
            </div>
        @endforeach
    </x-section>

    <x-section class="gray">
        <div class="col-md-3 col-sm-6 col-xs-12 row m-0">
            @for ($i=1;$i<=5;$i++)
                @include('blocks.fancybox_block',[
                    'image' => 'storage/images/about/image'.$i.'.jpg',
                    'addClass' => $i == 1 ? 'col-12 p-1' : 'col-md-6 col-xs-12 p-1',
                    'iconBlack' => $i == 3
                ])
            @endfor
        </div>
        <div class="col-md-9 col-sm-6 col-xs-12 p-4">
            <h2>{{ trans('content.certified_car_service') }}</h2>
            <p>{{ trans('content.certified_car_service_p1') }}</p>
            <p>{{ trans('content.certified_car_service_p2') }}</p>
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
            </div>
        @endif
    </x-section>

    <x-section class="gray">
        <div class="col-md-6 col-sm-12">
            <h2>{{ trans('content.free_check') }}</h2>
            <div class="accordion accordion-flush" id="freeCheck">
                @foreach($free_checks as $k => $check)
                    @include('blocks.accordion_block',[
                        'parentId' => 'freeCheck',
                        'itemId' => 'check'.$k,
                        'itemHead' => $check->name,
                        'itemText' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis diam in elit pellentesque vestibulum. Suspendisse turpis ligula, pharetra in pellentesque eu, tempus ac odio. Aliquam tincidunt quis nunc quis sollicitudin. Curabitur ornare ex quis fermentum auctor. Curabitur ut congue libero. Fusce ultricies enim sit amet dui tempor, eget sagittis massa sollicitudin. Sed suscipit urna non turpis tristique mattis. Nunc congue diam mauris, in commodo nunc euismod et. Aenean ultricies turpis lectus, sit amet porttitor velit tincidunt in. Mauris dictum erat urna, ut faucibus dolor efficitur sit amet.'
                    ])
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
                    @foreach($elected_brands as $k => $brand)
                        <a
                            class="nav-link text-center {{ !$k ? 'active' : '' }}"
                            id="{{ $brand->name }}-tab"
                            data-bs-toggle="tab"
                            href="#{{ $brand->name }}"
                            role="tab"
                            aria-controls="{{ $brand->name }}"
                            title="{{ $brand->name }}"
                            aria-selected="{{ !$k ? 'true' : 'false' }}"
                            style="width: {{ 100 / count($elected_brands) }}%"
                        >
                            <img src="{{ asset($brand->image) }}">
                        </a>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach($elected_brands as $k => $brand)
                    <div class="tab-pane fade {{ !$k ? 'show active' : '' }}" id="{{ $brand->name }}" role="tabpanel" aria-labelledby="{{ $brand->name }}-tab">
                        <ul class="price col-md-6 col-xs-12">
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                        </ul>
                        <ul class="price col-md-6 col-xs-12">
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                            <li>
                                <div class="job-name">Замена антифриза</div>
                                <div class="dots"><div></div></div>
                                <div class="job-price">1200 р.</div>
                            </li>
                        </ul>
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
            @foreach($questions as $k => $item)
                @include('blocks.accordion_block',[
                    'parentId' => 'faq',
                    'icon' => 'fa fa-lightbulb-o',
                    'itemId' => 'question'.$k,
                    'itemHead' => $item->question,
                    'itemText' => $item->answer
                ])
            @endforeach
        </div>
    </x-section>

    <x-section>
        <div class="rounded-block" id="record-repair">
            <h2>{{ trans('content.record_for_repair') }}</h2>
            <table class="w-100 pb-5">
                <tr>
                    <td class="align-top"><i class="fs-1 icon-redo2 text-secondary"></i></td>
                    <td class="align-top w-100 p-2"><p class="fs-6 text-uppercase">{!! trans('content.there_is_a_discount') !!}</p></td>
                </tr>
            </table>
            <form class="row" action="#">
                <div class="col-md-6 col-sm-12">
                    @include('blocks.input_block',[
                        'name' => 'user_name',
                        'placeholder' => trans('content.your_name')
                    ])
                </div>
                <div class="col-md-6 col-sm-12">
                    @include('blocks.input_block',[
                        'name' => 'phone',
                        'placeholder' => '+7 (___) ___-__-__'
                    ])
                </div>
                <div class="col-12">
                    @include('blocks.checkbox_block',[
                        'checked' => false,
                        'name' => 'i_agree',
                        'label' => trans('content.i_agree'),
                    ])
                    @include('blocks.button_block',[
                        'addClass' => 'mt-5',
                        'primary' => true,
                        'buttonText' => trans('content.send')
                    ])
                </div>
            </form>
        </div>
    </x-section>

    <x-section>
        <h2 class="w-100 text-center">{{ trans('content.in_the_waiting_room_for_each_client') }}</h2>
        @foreach(['fa fa-wifi', 'icon-cup2', 'icon-tv', 'icon-eye'] as $k => $icon)
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
        @foreach(['icon-alarm-check','icon-bubbles3','icon-cogs','icon-bookmark','icon-video-camera3',' icon-wallet','icon-trophy3','icon-gift'] as $k => $icon)
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
            @foreach($clients as $client)
                <img class="w-50 m-auto" title="{{ $client->name }}" src="{{ asset($client->image) }}" />
            @endforeach
        </div>
    </x-section>
@endsection
