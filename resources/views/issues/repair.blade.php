@extends('layouts.main')

@section('content')
    <x-section>
        <x-head level="1">
            {{ $repair->head.' ' }}
            @include('issues.blocks.car_name_block', ['car' => $repair->car, 'simple' => false])
        </x-head>

        <?php $count = 0; ?>
        <div id="indicator">
            <div class="dial left">
                @for($i=0;$i<count($left_digits);$i++)
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; left:{{ $left_digits[$i]['indent'].($i < 6 ? 'px' : '') }}; {{ $i == 6 ? 'transform:translate(-50%);' : '' }}">{{ round($price_step, -2) * $count }}</div>
                    <?php $count++; ?>
                @endfor
                @for($i=count($left_digits)-2;$i>=0;$i--)
                    <?php $count++; ?>
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; right:{{ $left_digits[$i]['indent'] }}px; {{ $i<=2 ? 'color:red;' : '' }}">{{ round($price_step, -2) * $count }}</div>
                @endfor
                <div class="arrow" style="transform:rotate(60deg);"></div>
                <div class="center">
                    <div>
                        <div class="descr">{{ trans('indicator.price') }}</div>
                        <div class="value">
                            @include('issues.blocks.price_from_block')
                            {{ $price }}<span>₽</span>

                        </div>
                        <div class="old-price">
                            <img src="{{ asset('storage/images/indicator/red_line.svg') }}" />
                            @include('issues.blocks.price_from_block')
                            {{ $old_price }}<span>₽</span>
                        </div>
                    </div>
                </div>
                <div class="saving">
                    <span>{{ trans('indicator.saving') }}</span><br>
                    @include('issues.blocks.price_from_block')
                    {{ $old_price - $price }}<span>₽</span>
                </div>
            </div>
            <div class="middle-dial">
                {!! trans('indicator.recommendation') !!}
                @if ($repair->upon_reaching_years)
                    <div class="block first">
                        <img src="{{ asset('storage/images/indicator/sand_clock_icon.svg') }}" />
                        <div>
                            {{ $repair->upon_reaching_years }}
                            @if (substr($repair->upon_reaching_years, -1) == 1)
                                {{ trans('indicator.years1') }}
                            @else
                                {{ trans('indicator.years2') }}
                            @endif
                        </div>
                    </div>
                @endif
                @if ($repair->upon_reaching_mileage)
                    <div class="block second"><img src="{{ asset('storage/images/indicator/wheel_icon.svg') }}" /><div>{{ $repair->upon_reaching_mileage }}<br><span>{{ trans('indicator.mileage') }}</span></div></div>
                @endif
                @if ($repair->upon_reaching_conditions)
                    <div class="block third"><img src="{{ asset('storage/images/indicator/tool_icon.svg') }}" /><div>{{ trans('indicator.general_condition') }}</div></div>
                @endif
                @if ($repair->free_diagnostics)
                    <div class="block fourth">{{ trans('indicator.free_diagnostics') }}</div>
                @endif
                @if ($repair->warranty_years)
                    <div class="block fifth">{{ trans('indicator.warranty_years'.($repair->warranty_years <= 4 ? '1' : '2'), ['years' => $repair->warranty_years]) }}</div>
                @endif
            </div>
            <div class="dial right">
                <div class="digits" style="margin-top:287px; left:50%; transform:translate(-50%);">0<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:270px; left:115px;">1<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:220px; left:70px;">2<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:160px; left:50px;">3<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:95px; left:70px;">4<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:55px; left:115px;">5<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:40px; left:50%; transform:translate(-50%);">6<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:55px; right:110px;">7<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:95px; right:65px;">8<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:160px; right:45px;">9<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:220px; right:60px;">10<span>{{ trans('indicator.hour') }}</span></div>
                <div class="digits" style="margin-top:270px; right:105px;">11<span>{{ trans('indicator.hour') }}</span></div>
                <div class="arrow"></div>
                <div class="center">
                    <div class="descr">{{ trans('indicator.issue_duration') }}</div>
                    <div class="value">~{{ $repair->work_time }}<span>{{ trans('indicator.hour') }}</span></div>
                </div>
            </div>
        </div>
        <p class="w-100 mt-3 mb-4 text-center"><b>{!! trans('indicator.you_can_wait') !!}</b></p>

        @if (count($repair->images))
            <div id="repair-images" class="owl-carousel">
                @foreach ($repair->images as $image)
                    <div class="framed-image">
                        <a class="fancybox" href="{{ asset($image->image) }}"><img src="{{ asset($image->preview) }}" /></a>
                    </div>
                @endforeach
            </div>
        @endif

        @include('blocks.online_record_block',[
            'type' => 'online_appointment_for_repair',
            'addClass' => 'mt-4'
        ])

        @if (count($repair->recommendedWorks))
            <x-head level="2" class="mt-4">{{ trans('content.we_recommend_with_this_work') }}</x-head>
            <x-table class="simple">
                @include('issues.blocks.repair_table.table_list_repair_head_block')
                @foreach($repair->recommendedWorks as $recommendedWork)
                    @include('issues.blocks.repair_table.table_list_repair_item_block', [
                        'car' => $recommendedWork->work->car,
                        'item' => $recommendedWork->work
                    ])
                @endforeach
            </x-table>
        @endif
    </x-section>
    <script>
        window.priceIndicator = parseInt("{{ 240 / (round($price_step, -1) * $count) * $price }}");
        window.timeIndicator = parseInt("{{ $repair->work_time * 30 }}");
    </script>
@endsection
