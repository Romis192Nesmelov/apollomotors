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
                @for ($i=0;$i<count($left_digits);$i++)
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; left:{{ $left_digits[$i]['indent'].($i < 6 ? 'px' : '') }}; {{ $i == 6 ? 'transform:translate(-50%);' : '' }}">{{ $price_step * $count }}</div>
                    <?php $count++; ?>
                @endfor
                @for ($i=count($left_digits)-2;$i>=0;$i--)
                    <?php $count++; ?>
                    <div class="digits" style="margin-top:{{ $left_digits[$i]['top'] }}px; right:{{ $left_digits[$i]['indent'] }}px; {{ $i<=2 ? 'color:red;' : '' }}">{{ $price_step * $count }}</div>
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
                @for ($i=0;$i<12;$i++)
                    <?php
                    $style = '';
                    foreach ($right_digits[$i] as $name => $value) {
                        if (is_int($value)) $value .='px';
                        $style .= $name.':'.$value.'; ';
                    }
                    ?>
                    <div class="digits" style="{{ $style }}">{{ $i }}<span>{{ trans('indicator.hour') }}</span></div>
                @endfor
                <div class="arrow"></div>
                <div class="center">
                    <div class="descr">{{ trans('indicator.issue_duration') }}</div>
                    <div class="value">~{{ $repair->work_time }}<span>{{ trans('indicator.hour') }}</span></div>
                </div>
            </div>
        </div>
        <p class="w-100 mt-3 text-center"><b>{!! trans('indicator.you_can_wait') !!}</b></p>
        @if (!count($repair->images))
            @include('blocks.online_record_block',[
                'type' => 'online_appointment_for_repair',
                'addClass' => 'mt-4'
            ])
        @endif
    </x-section>

    @if (count($repair->images))
        <x-section class="gray">
            <div id="repair-images" class="owl-carousel">
                @foreach ($repair->images as $image)
                    <div class="framed-image">
                        <a class="fancybox" href="{{ asset($image->image) }}"><img src="{{ asset($image->preview) }}" /></a>
                    </div>
                @endforeach
            </div>
        </x-section>
        <x-section>
            @include('blocks.online_record_block',[
                'type' => 'online_appointment_for_repair',
                'addClass' => 'mt-4'
            ])
        </x-section>
    @endif

    @if (count($repair->recommendedWorks))
        <x-section class="gray">
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
        </x-section>
    @endif

    <script>
        window.timeIndicator = parseInt("{{ $repair->work_time * 30 }}");
    </script>
@endsection
