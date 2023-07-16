@extends('layouts.main')

@section('content')
    <x-section class="contacts">
        <x-head level="1">{{ trans('menu.contacts') }}</x-head>
        @if ($contacts[0]->active)
            <p class="mb-3">
                <b>{{ $contacts[0]->contact }}.</b>
                @if ($contacts[1]->active)
                    {{ $contacts[1]->contact }}
                @endif
            </p>
        @endif

        @if ($contacts[2]->active || $contacts[3]->active)
            <p class="mb-1">{{ trans('content.email_address') }}
                @for($i=2;$i<=3;$i++)
                    @if ($contacts[$i]->active)
                        @include('blocks.email_block',['email' => $contacts[$i]->contact, 'icon' => null])
                    @endif
                @endfor
            </p>
        @endif

        @if ($contacts[5]->active || $contacts[6]->active)
            <p>{{ trans('content.phone') }}
                @for($i=5;$i<=6;$i++)
                    @if ($contacts[$i]->active)
                        @include('blocks.phone_block',['phone' => $contacts[$i]->contact, 'icon' => null])
                    @endif
                @endfor
            </p>
        @endif

        <h2 class="w-100 text-center">{{ trans('contacts.how_to_get_to_us_by_car') }}</h2>

        @include('blocks.hr_block')

        <div class="col-md-6 col-sm-12">
            @include('blocks.google_map_block',[
                'mapHead' => trans('contacts.by_side1'),
                'gMap' => '!1m26!1m12!1m3!1d17987.24382734718!2d37.41019626421428!3d55.69932335449243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d55.7107345!2d37.4218518!4m5!1s0x46b54e7e7307703d%3A0xab87b59e3c6ba048!2z0YPQuy4g0JPQtdC90LXRgNCw0LvQsCDQlNC-0YDQvtGF0L7QstCwLCAxMNCULCDQnNC-0YHQutCy0LAsIDEyMTM1Nw!3m2!1d55.702127!2d37.433104!5e0!3m2!1sru!2sru!4v1512206339889'
            ])
            @include('blocks.schema_road_block',[
                'roads' => [['image' => 'v1_1', 'description' => trans('contacts.route1')]],
                'uCount' => [1,2]
            ])
        </div>
        <div class="col-md-6 col-sm-12">
            @include('blocks.google_map_block',[
                'mapHead' => trans('contacts.by_side2'),
                'gMap' => '!1m28!1m12!1m3!1d12719.589396871526!2d37.414046315983754!3d55.697211200915376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x46b54e6f25aaa95d%3A0xcfec40a042ddd16!2z0JzQmtCQ0JQgNTIg0LrQvCwg0JzQvtGB0LrQstCwLCAxMjEzNTM!3m2!1d55.698958999999995!2d37.4032008!4m5!1s0x46b54e80f2422009%3A0xf106d124d5859cd3!2z0YPQuy4g0JPQtdC90LXRgNCw0LvQsCDQlNC-0YDQvtGF0L7QstCwLCAxMNCRLCDQnNC-0YHQutCy0LAsIDEyMTM1Nw!3m2!1d55.7035882!2d37.439455699999996!5e0!3m2!1sru!2sru!4v1671079402492!5m2!1sru!2sru'
            ])
            @include('blocks.schema_road_block',[
                'roads' => [['image' => 'v2_1', 'description' => trans('contacts.route2')]],
                'uCount' => [1,2]
            ])
        </div>
        <div class="col-md-6 col-sm-12">
            @include('blocks.google_map_block',[
                'mapHead' => trans('contacts.by_side3'),
                'gMap' => '!1m30!1m12!1m3!1d17989.15960170662!2d37.395033164206154!3d55.695160354421496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m15!3e0!4m3!3m2!1d55.708402799999995!2d37.389880399999996!4m3!3m2!1d55.6874081!2d37.428907699999996!4m5!1s0x46b54e7e7307703d%3A0xab87b59e3c6ba048!2z0YPQuy4g0JPQtdC90LXRgNCw0LvQsCDQlNC-0YDQvtGF0L7QstCwLCAxMNCULCDQnNC-0YHQutCy0LAsIDEyMTM1Nw!3m2!1d55.702127!2d37.433104!5e0!3m2!1sru!2sru!4v1512207802214'
            ])
            @include('blocks.schema_road_block',[
                'roads' => [['image' => 'v3_1', 'description' => trans('contacts.route3')],['image' => 'v3_2', 'description' => trans('contacts.route4')]],
                'uCount' => [2]
            ])
        </div>
        <div class="col-md-6 col-sm-12">
            @include('blocks.google_map_block',[
                'mapHead' => trans('contacts.by_side4'),
                'gMap' => '!1m28!1m12!1m3!1d17994.52689956204!2d37.41313426418343!3d55.683496054222935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m3!3m2!1d55.6654718!2d37.430013599999995!4m3!3m2!1d55.698850699999994!2d37.429013!4m3!3m2!1d55.701888!2d37.4325548!5e0!3m2!1sru!2sru!4v1512210931014'
            ])
            @include('blocks.schema_road_block',[
                'roads' => [['image' => 'v4_1', 'description' => trans('contacts.route5')]],
                'uCount' => [2],
                'start' => 2
            ])
        </div>

        <div class="col-12">
            @include('blocks.google_map_block',[
                'mapHead' => trans('contacts.how_to_find_us_on_the_territory'),
                'gMap' => '!1m24!1m12!1m3!1d2248.3184288875236!2d37.43158751592864!3d55.70083658053952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e0!4m3!3m2!1d55.699644!2d37.4334004!4m3!3m2!1d55.7020974!2d37.432349099999996!5e0!3m2!1sru!2sru!4v1671164125790!5m2!1sru!2sru'
            ])
        </div>

        <div class="col-12 buses">
            <x-head level="3" class="mt-4">{{ trans('contacts.by_public_transport') }}</x-head>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    @for($s=1;$s<=3;$s++)
                        @include('blocks.bus_stops_block',['description' => trans('contacts.busStops'.$s)])
                    @endfor
                </div>
                <div class="col-md-6 col-sm-12">
                    @for($s=4;$s<=6;$s++)
                        @include('blocks.bus_stops_block',['description' => trans('contacts.busStops'.$s)])
                    @endfor
                </div>
            </div>
            <p>{{ trans('contacts.final_route') }}</p>
        </div>
    </x-section>
@endsection
